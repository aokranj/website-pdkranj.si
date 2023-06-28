<?php

namespace PublishPress\Future\Modules\Expirator\ExpirationActions;

use PublishPress\Future\Framework\WordPress\Models\TermsModel;
use PublishPress\Future\Modules\Expirator\ExpirationActionsAbstract;
use PublishPress\Future\Modules\Expirator\Interfaces\ExpirationActionInterface;
use PublishPress\Future\Modules\Expirator\Models\ExpirablePostModel;

defined('ABSPATH') or die('Direct access not allowed.');

class PostCategoryAdd implements ExpirationActionInterface
{
    const SERVICE_NAME = 'expiration.actions.post_category_add';

    /**
     * @var ExpirablePostModel
     */
    private $postModel;

    /**
     * @var \PublishPress\Future\Framework\WordPress\Facade\ErrorFacade
     */
    private $errorFacade;

    /**
     * @var array
     */
    private $log = [];

    /**
     * @param ExpirablePostModel $postModel
     * @param \PublishPress\Future\Framework\WordPress\Facade\ErrorFacade $errorFacade
     */
    public function __construct($postModel, $errorFacade)
    {
        $this->postModel = $postModel;
        $this->errorFacade = $errorFacade;
    }

    public function __toString()
    {
        return ExpirationActionsAbstract::POST_CATEGORY_ADD;
    }

    /**
     * @inheritDoc
     */
    public function getNotificationText()
    {
        if (empty($this->log)) {
            return sprintf(
                __('No terms were added to the %s.', 'post-expirator'),
                strtolower($this->postModel->getPostTypeSingularLabel())
            );
        } elseif (isset($this->log['error'])) {
            return $this->log['error'];
        }

        $termsModel = new TermsModel();

        return sprintf(
            __(
                'The following terms (%s) were added to the %s: "%s". The full list of terms on the post is: %s.',
                'post-expirator'
            ),
            $this->log['expiration_taxonomy'],
            $termsModel->getTermNamesByIdAsString($this->log['terms_added'], $this->log['expiration_taxonomy']),
            strtolower($this->postModel->getPostTypeSingularLabel()),
            $termsModel->getTermNamesByIdAsString($this->log['updated_terms'], $this->log['expiration_taxonomy'])
        );
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $expirationTaxonomy = $this->postModel->getExpirationTaxonomy();
        $originalTerms = $this->postModel->getTermIDs($expirationTaxonomy);
        $termsToAdd = $this->postModel->getExpirationCategoryIDs();

        $updatedTerms = array_merge($originalTerms, $termsToAdd);

        $result = $this->postModel->setTerms($updatedTerms, $expirationTaxonomy);

        $resultIsError = $this->errorFacade->isWpError($result);

        if (! $resultIsError) {
            $this->log = [
                'expiration_taxonomy' => $expirationTaxonomy,
                'original_terms' => $originalTerms,
                'terms_added' => $termsToAdd,
                'updated_terms' => $updatedTerms,
            ];
        } else {
            $this->log['error'] = $result->get_error_message();
        }

        return ! $resultIsError;
    }

    /**
     * @return string
     */
    public static function getLabel()
    {
        return __('Keep all current terms and add new terms', 'post-expirator');
    }

    /**
     * @inheritDoc
     */
    public function getDynamicLabel()
    {
        return self::getLabel();
    }
}
