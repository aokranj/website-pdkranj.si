<?php
/**
 * WP Dark Mode - Social Share Channels
 * Manage social share channels
 *
 * @package WP_DARK_MODE
 * @since 2.0
 */

// Exit if accessed directly.
// phpcs:ignore
defined( 'ABSPATH' ) || exit();
?>

<!-- Manage channels	-->
<section class="w-full max-md p-3 max-w-md" x-show="isTab('channels')" x-transition:enter.opacity.40>
	<!-- enable social share	-->
	<div class="flex items-center justify-between mb-8">
		<label for="enable" class="font-semibold text-sm text-slate-700 cursor-pointer w-3/4"><?php esc_html_e( 'Enable Social Share (Inline Button)', 'wp-dark-mode' ); ?></label>
		<label for="enable" class="_switcher">
			<input type="checkbox" id="enable" x-model="options.enable" @change="toggleSocialShare">
			<span></span>
		</label>
	</div>

	<!-- content	-->
	<div class="w-full transition duration-150 relative" x-show="options.enable">
	<!-- :class=" {'opacity-20 pointer-events-none' : !options.enable}" -->
		<label class="font-semibold text-sm text-slate-700 cursor-pointer block mb-2"><?php esc_html_e( 'Enable your preferred social channels', 'wp-dark-mode' ); ?></label>
		<div class="relative">
			<input type="text" x-model="state.search_channels" class="input-text text-xs" placeholder="<?php esc_html_e( 'Search Channel', 'wp-dark-mode' ); ?>">

			<svg xmlns="http://www.w3.org/2000/svg" @click.prevent="state.search_channels = ''" class="w-3 fill-current cursor-pointer absolute right-2 top-1/2 -translate-y-1/2 opacity-30 hover:opacity-100 transition duration-150" 
				viewBox="0 0 16 16">
				<path x-show="!state.search_channels" d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
				<path x-show="state.search_channels" d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
			</svg>
		</div>

		<!-- grid social icons	-->
		<div x-show="filteredChannels.length" 
			class="_social-share-container _icons-grid _max-height grid gap-3 grid-cols-2 md:grid-cols-5 mt-4 inline flex-wrap overflow-y-auto scrollbar-thin hover:scrollbar-thumb-slate-300 scrollbar-track-transparent">

			<template x-for="channel in filteredChannels">
				<!-- single social channel	-->
				<div 
					class="inline-flex flex-col justify-center items-center gap-1 cursor-pointer _channels-container opacity-90 hover:opacity-100 transition duration-150 hover:grayscale-0" 
					:class="{ 'grayscale': !isChannelEnabled(channel.id) }" 
					@mouseover="channel.hover = true" @mouseleave="channel.hover = false"  @click.prevent="toggleChannel(channel.id)"
				>
					<!-- channel icon  -->
					<span class="text-lg w-8 h-8 pt-0.5 rounded-full text-white flex items-center justify-center _icon-svg" :class="[channel.hover || isChannelEnabled(channel.id) ? channel.class : 'bg-gray-300']" x-html="getIcon(channel.id)"></span>
					<!-- channel name -->
					<span class="text-xs text-center text-slate-600" x-text="channel.name"></span>

					<!-- tick, visible when the channel is enabled  -->
					<template x-if="channel.enabled">
						<svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4" :class="{ 'text-blue-500' : isChannelEnabled(channel.id), 'opacity-10' : !isChannelEnabled(channel.id) }" viewBox="0 0 16 16">
							<path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
						</svg>
					</template>

					<!-- cross, visible when the channel is disabled  -->
					<template x-if="!channel.enabled">
						<svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 text-slate-300" viewBox="0 0 16 16">
							<path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
						</svg>
					</template>

				</div>
				<!-- single icon ends	-->
			</template>

		</div>


		<div x-show="!filteredChannels.length" class="text-slate-400 text-center mt-4">
			<?php esc_html_e( 'Not found <span class="italic text-blue-500" x-text="state.search_channels"></span>', 'wp-dark-mode' ); ?>
		</div>

		<!-- channel footer buttons	-->
		<div class="flex flex-between gap-3 my-6 justify-center text-xs">

			<!-- show all button	-->
			<a href="javascript:;" 
				class="bg-transparent px-2 py-1 rounded-sm font-medium focus:outline-none text-blue-400 hover:ring-blue-600 ring-1 ring-blue-500 focus:text-blue-500 hover:bg-blue-50 inline-flex items-center gap-1 transition duration-150" 
				@click.prevent="state.showAllChannels = !state.showAllChannels">
				<svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-3 transition duration-300" :class="{'rotate-180' : state.showAllChannels}" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
				</svg>
				<span x-text="state.showAllChannels ? ' <?php esc_html_e( 'See less channels', 'wp-dark-mode' ); ?>' : ' <?php esc_html_e( 'See more channels', 'wp-dark-mode' ); ?>'"></span>
			</a>

			<!-- Unlock button -->
			<a href="javascript:;" 
				x-show="isFree" 
				class="bg-red-50 px-2 py-1 rounded-sm font-medium focus:outline-none focus:ring-red-400 text-red-600 ring-1 ring-red-200 hover:text-red-400 hover:opacity-75 transition duration-150" 
				@click.prevent="showPromo">
				<?php esc_html_e( 'Unlock all channels', 'wp-dark-mode' ); ?>
			</a>
		</div>

		<!-- manage channels	-->
		<div class="mt-8">
			<!-- title  -->
			<label class="font-semibold text-sm text-slate-700 cursor-pointer mb-2 flex gap-2">
				<?php esc_html_e( 'Manage channels', 'wp-dark-mode' ); ?> 
				<span class="wpdarkmode-tooltip" title="<?php esc_html_e( 'Reorder your social channels. You can edit the channel label and device visibility for each. Drag channels to change their order.', 'wp-dark-mode' ); ?>"></span>
			</label>

			<!-- manage channels; sortable, editable  -->
			<div class="flex flex-col gap-2" dropzone="true">

				<template x-for="channel in enabledChannels">

					<!-- single channel -->
					<div class="flex flex-col gap-2 w-fit relative" 
						dropzone="true" 
						draggable="true"
						@dragstart="state.draggingChannel = channel.id" 
						@dragenter="handleDrag($event, channel.id)" 
						@dragend="handleDrop($event, channel.id)" 
						:class="`_channel-${channel.id}`">

						<div class="w-full cursor-pointer _social-share-container inline" tabindex="0">

							<!-- move icon -->
							<span tabindex="1" class="text-slate-200 transition duration-100 h-full flex items-center justify-center text-2xl cursor-grab" :class="{'text-blue-600' : state.draggingChannel === channel.id }">
								<svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-8" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
								</svg>
							</span>

							<!-- channel name -->
							<div class="flex items-center bg-slate-200 _channel-name group">
								<div class="bg-slate-600 text-white h-10 w-10 flex items-center justify-center text-base _icon-svg flex-shrink-0" :class="`_icon-${channel.id}`" x-html="getIcon(channel.id)"></div>
								<div class="flex w-28 items-center gap-2 relative">
									<!-- editable name  -->
									<div class="text-sm w-full pl-3 font-medium flex items-center focus:outline-none transition duration-100 focus:ring focus:ring-blue-400 h-8 overflow-hidden text-ellipsis whitespace-nowrap" 
										x-text="channel.name" 
										contenteditable="true" 
										@blur="channel.name = $event.target.innerText">
									</div>
									<!-- pencil icon  -->
									<svg xmlns="http://www.w3.org/2000/svg" 
										class="fill-current w-3 absolute right-2.5 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 group-focus-within:!opacity-0 transition-opacity duration-200" 
										viewBox="0 0 16 16" 
										@click.prevent="editableChannel($event)">										
										<?php // phpcs:ignore ?>
										<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" /> 
									</svg>
								</div>
							</div>

							<!--  AI channels Prompt -->
							<template x-if="isAIChannel(channel.id)">
								<span 
									@click.prevent="editPrompt(channel)" 
									class="bg-slate-200 h-10 w-24 flex items-center justify-center text-xs transition duration-200 cursor-pointer"
									@mouseenter="TooltipManager.show('Edit AI prompt', $event)"
									@mouseleave="TooltipManager.hide()">
									<div class="bg-gray-50 hover:bg-blue-50 px-3 py-1.5 flex items-center justify-center rounded-full border border-gray-300 hover:border-blue-500 shadow-sm transition-all duration-200 group">
										<span class="text-xs text-gray-600 group-hover:text-blue-600 transition-colors duration-200 font-medium">Prompt</span>
										<svg class="w-3 h-3 ml-1 text-gray-500 group-hover:text-blue-600 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
											<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
										</svg>
									</div>
								</span>
							</template>

							<!-- visibility: mobile -->
							<span 
								@click.prevent="channel.visibility.mobile = !channel.visibility.mobile" 
								class="bg-slate-200 h-10 w-11 flex items-center justify-center text-base transition duration-100 cursor-pointer" 
								:class="channel.visibility.mobile ? ['text-blue-500'] : ['text-slate-300']" 
								@mouseenter="TooltipManager.show('Hide/Show on Mobile', $event)"
								@mouseleave="TooltipManager.hide()"
								x-html="constant.devices.mobile.icon">
							</span>

							<!-- visibility: desktop -->
							<span 
								@click.prevent="channel.visibility.desktop = !channel.visibility.desktop" 
								class="bg-slate-200 h-10 w-11 flex items-center justify-center text-base transition duration-100 cursor-pointer" 
								:class="channel.visibility.desktop ? ['text-blue-500'] : ['text-slate-300']" 
								@mouseenter="TooltipManager.show('Hide/Show on PC/Laptop', $event)"
								@mouseleave="TooltipManager.hide()"
								x-html="constant.devices.desktop.icon">
							</span>

							<!-- unselect channel -->
							<span 
								@click.prevent="toggleChannel(channel.id)" 
								class="bg-slate-200 text-slate-400 hover:text-red-600 transition duration-150 h-10 w-11 flex items-center justify-center text-base cursor-pointer"
								@mouseenter="TooltipManager.show('Delete', $event, 'right')"
								@mouseleave="TooltipManager.hide()">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="fill-current w-6">
									<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
								</svg>
							</span>

						</div>

						<!-- sort dropzone	-->
						<template x-if="state.draggingChannel && state.draggingChannel === channel.id">
							<div class="h-full w-full absolute bg-white shadow z-20 ring rounded-sm ring-blue-400 flex items-center justify-center text-center font-semibold tracking-wider" 
								draggable="true">Drop here</div>
						</template>
					</div>
				</template>
			</div>
		</div>

	</div>

	<!-- Prompt Edit Modal -->
	<div x-show="state.promptModal.show" 
		x-cloak
		style="display: none;"
		class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
		@click.self="closePromptModal()">
		
		<div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4 relative">
			<!-- Close X button -->
			<button @click="closePromptModal()" 
					class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition duration-150">
				<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
					<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
				</svg>
			</button>

			<!-- Modal Header -->
			<div class="mb-4">
				<h3 class="text-xl font-semibold text-gray-900"><?php esc_html_e( 'Edit Prompt', 'wp-dark-mode' ); ?></h3>
				<p class="text-sm text-gray-600 mt-2">
					<?php esc_html_e( 'Customize the prompt that will be sent to', 'wp-dark-mode' ); ?> <span x-text="state.promptModal.channel?.name" class="font-medium"></span> <?php esc_html_e( 'when someone clicks this share button. Visitors will be redirected with this prompt pre-filled.', 'wp-dark-mode' ); ?>
				</p>
			</div>
			
			<!-- Prompt Textarea with Free/Pro Logic -->
			<div class="mb-4 relative">
				<!-- Textarea with its own group for hover -->
				<div class="group/textarea relative">
					<textarea 
						x-model="state.promptModal.prompt"
						@input="updateChannelPrompt()"
						:class="{
							'group-hover/textarea:opacity-50 bg-gray-100 text-gray-500 cursor-not-allowed': isFree
						}"
						:disabled="isFree"
						class="w-full h-32 px-3 py-2 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
						placeholder="<?php esc_attr_e( 'Visit this URL: {page_url} and summarize the content for me.', 'wp-dark-mode' ); ?>"></textarea>
					
					<!-- Upgrade Button on Textarea Hover Only (Free Version Only) -->
					<div x-show="isFree" 
						class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/textarea:opacity-100 transition-all duration-300 pointer-events-none group-hover/textarea:pointer-events-auto">
						<button 
							@click.prevent="showPromo()"
							class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2.5 rounded-full shadow-lg hover:shadow-xl hover:shadow-blue-500/20 transition-all duration-300 transform hover:scale-105 active:scale-95 pointer-events-auto group/btn">
							<div class="flex items-center space-x-2">
								<!-- Lock Icon (smaller) -->
								<div class="relative">
									<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
									</svg>
									<!-- Small indicator dot -->
									<div class="absolute -top-0.5 -right-0.5 w-1.5 h-1.5 bg-yellow-400 rounded-full"></div>
								</div>
								<span class="text-sm font-bold"><?php esc_html_e( 'Upgrade Now', 'wp-dark-mode' ); ?></span>
								<!-- Chevron with hover animation (smaller) -->
								<svg class="w-3.5 h-3.5 transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
								</svg>
							</div>
						</button>
					</div>
				</div>
				
				<!-- Available Variables (separate from textarea hover) -->
				<div class="mt-3 text-xs" :class="isFree ? 'text-gray-400' : 'text-gray-500'">
					<span class="font-medium"><?php esc_html_e( 'Available variables:', 'wp-dark-mode' ); ?></span>
					<span class="ml-1">{page_title}, {page_url}, {site_name}, {site_url}, {language}</span>
				</div>
			</div>
			
			<!-- Action Buttons - Alternative Design -->
			<div class="flex justify-between items-center">
				<!-- Reset Button - Same Height as Done Button -->
				<button 
					@click="isFree ? showPromo() : resetToDefault()" 
					:disabled="isFree"
					:class="{
						'opacity-50 cursor-not-allowed hover:cursor-not-allowed': isFree,
						'hover:bg-red-50 hover:text-red-600 hover:border-red-300 group hover:cursor-pointer': !isFree
					}"
					class="inline-flex items-center px-3 py-1.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-600 text-sm font-medium transition-all duration-200">
					
					<!-- Reset Icon with conditional animation -->
					<svg 
						:class="{
							'transition-transform group-hover:rotate-180 duration-300': !isFree,
							'': isFree
						}"
						class="w-3.5 h-3.5" 
						fill="none" 
						stroke="currentColor" 
						viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
					</svg>
					<span style="margin-left: 5px;"><?php esc_html_e( 'Reset to default', 'wp-dark-mode' ); ?></span>
				</button>
				
				<!-- Done Button - Same Height as Reset Button -->
				<button 
					@click="isFree ? showPromo() : donePrompt()" 
					:disabled="isFree"
					:class="{
						'opacity-50 cursor-not-allowed hover:cursor-not-allowed': isFree,
						'group hover:cursor-pointer': !isFree
					}"
					class="inline-flex items-center px-3 py-1.5 bg-gray-50 border border-gray-200 rounded-lg text-gray-600 font-medium text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
					style="transition: all 0.2s;"
					@mouseenter="!isFree && ($el.style.backgroundColor = 'rgb(59 130 246)', $el.style.color = 'white', $el.style.borderColor = 'rgb(59 130 246)')"
					@mouseleave="!isFree && ($el.style.backgroundColor = 'rgb(249 250 251)', $el.style.color = 'rgb(75 85 99)', $el.style.borderColor = 'rgb(229 231 235)')">
					<span><?php esc_html_e( 'Done', 'wp-dark-mode' ); ?></span>
				</button>
			</div>
		</div>
	</div>

</section>