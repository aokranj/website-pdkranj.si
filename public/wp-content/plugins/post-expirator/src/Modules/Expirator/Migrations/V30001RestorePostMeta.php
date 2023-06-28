<?php
/**
 * Copyright (c) 2023. PublishPress, All rights reserved.
 */

namespace PublishPress\Future\Modules\Expirator\Migrations;

use PublishPress\Future\Core\HookableInterface;
use PublishPress\Future\Framework\WordPress\Facade\OptionsFacade;
use PublishPress\Future\Modules\Expirator\Adapters\CronToWooActionSchedulerAdapter;
use PublishPress\Future\Modules\Expirator\HooksAbstract as ExpiratorHooks;
use PublishPress\Future\Modules\Expirator\Interfaces\CronInterface;
use PublishPress\Future\Modules\Expirator\Interfaces\MigrationInterface;
use PublishPress\Future\Modules\Expirator\Schemas\ActionArgsSchema;

use function tad\WPBrowser\vendorDir;

defined('ABSPATH') or die('Direct access not allowed.');

class V30001RestorePostMeta implements MigrationInterface
{
    const HOOK = ExpiratorHooks::ACTION_MIGRATE_RESTORE_POST_META;

    /**
     * @var \PublishPress\Future\Modules\Expirator\Interfaces\CronInterface
     */
    private $cronAdapter;

    private $hooksFacade;

    /**
     * @var \PublishPress\Future\Framework\WordPress\Facade\OptionsFacade
     */
    private $optionsFacade;

    /**
     * @var \Closure
     */
    private $expirablePostModelFactory;

    private $actionStore;

    /**
     * @param \PublishPress\Future\Modules\Expirator\Interfaces\CronInterface $cronAdapter
     * @param \PublishPress\Future\Core\HookableInterface $hooksFacade
     * @param \PublishPress\Future\Framework\WordPress\Facade\OptionsFacade $optionsFacade
     * @param \Closure $expirablePostModelFactory
     * @param $actionStore
     */
    public function __construct(
        CronInterface $cronAdapter,
        HookableInterface $hooksFacade,
        OptionsFacade $optionsFacade,
        \Closure $expirablePostModelFactory,
        $actionStore
    ) {
        $this->cronAdapter = $cronAdapter;
        $this->hooksFacade = $hooksFacade;
        $this->optionsFacade = $optionsFacade;
        $this->actionStore = $actionStore;

        $this->hooksFacade->addAction(self::HOOK, [$this, 'migrate']);
        $this->hooksFacade->addAction(
            ExpiratorHooks::FILTER_ACTION_SCHEDULER_LIST_COLUMN_HOOK,
            [$this, 'formatLogActionColumn'],
            10,
            2
        );
        $this->expirablePostModelFactory = $expirablePostModelFactory;
    }

    /**
     * @return array
     */
    private function getScheduledActions()
    {
        $events = [];

        $query = array(
            'per_page' => -1,
            'offset' => 0,
            'status' => '',
            'orderby' => 'ID',
            'order' => 'ASC',
            'search' => '',
            'group' => CronToWooActionSchedulerAdapter::SCHEDULED_ACTION_GROUP,
        );

        $actions = $this->actionStore->query_actions($query);
        $modelFactory = $this->expirablePostModelFactory;

        foreach ($actions as $actionId) {
            try {
                $action = $this->actionStore->fetch_action($actionId);
            } catch (\Exception $e) {
                continue;
            }

            $args = $action->get_args();
            if (!isset($args['workflow']) || $args['workflow'] !== 'expire') {
                continue;
            }

            $postId = $args['postId'];
            $postModel = $modelFactory($postId);

            $expirationData = $postModel->getExpirationDataAsArray();

            if ($expirationData['date'] == 0) {
                continue;
            }

            $postModel->updateMeta('_expiration-date-type', $expirationData['expireType']);
            $postModel->updateMeta('_expiration-date-status', 'saved');
            $postModel->updateMeta('_expiration-date-taxonomy', $expirationData['categoryTaxonomy']);
            $postModel->updateMeta('_expiration-date-categories', $expirationData['category']);
            $postModel->updateMeta('_expiration-date', $expirationData['date']);
            $postModel->updateMeta('_expiration-date-options', $postModel->getExpirationOptions());
        }

        return $events;
    }

    public function migrate()
    {
        $events = $this->getScheduledActions();
    }

    /**
     * @param string $text
     * @param array $row
     * @return string
     */
    public function formatLogActionColumn($text, $row)
    {
        if ($row['hook'] === self::HOOK) {
            return __('Restore post meta data after v3.0.1', 'publishpress-future');
        }

        return $text;
    }
}
