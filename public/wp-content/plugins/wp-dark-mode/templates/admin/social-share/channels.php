 <!-- Manage channels  -->
 <section class="w-full max-md p-3 max-w-md" x-show="isTab('channels')" x-transition:enter.opacity.40>

     <!-- enable social share  -->
     <div class="flex items-center justify-between mb-8">
         <label for="enable" class="font-semibold text-sm text-slate-700 cursor-pointer w-3/4"><?php echo __('Enable Social Share (Inline Button)', 'wp-dark-mode'); ?></label>
         <label for="enable" class="_switcher">
             <input type="checkbox" id="enable" x-model="options.enable" @change="toggleSocialShare">
             <span></span>
         </label>
     </div>

     <!-- content  -->
     <div class="w-full transition duration-150 relative" x-show="options.enable" :class=" {'opacity-20 pointer-events-none' : !options.enable}">

         <label class="font-semibold text-sm text-slate-700 cursor-pointer block mb-2"><?php echo __('Enable your preferred social channels', 'wp-dark-mode'); ?></label>
         <div class="relative">
             <input type="text" x-model="state.search_channels" class="input-text text-xs" placeholder="Search Channel">

             <!-- <i class="fa-solid" :class="state.search_channels ? 'fa-xmark' : 'fa-search'"></i> -->
             <svg xmlns="http://www.w3.org/2000/svg" @click.prevent="state.search_channels = ''" class="w-3 fill-current cursor-pointer absolute right-2 top-1/2 -translate-y-1/2 opacity-30 hover:opacity-100 transition duration-150" viewBox="0 0 16 16">
                 <path x-show="!state.search_channels" d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                 <path x-show="state.search_channels" d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
             </svg>

         </div>

         <!-- grid social icons  -->
         <div x-show="filteredChannels.length" class="_social-share-container _icons-grid _max-height grid gap-3 grid-cols-2 md:grid-cols-5 mt-4 inline flex-wrap overflow-y-auto scrollbar-thin hover:scrollbar-thumb-slate-300 scrollbar-track-transparent">

             <template x-for="channel in filteredChannels">
                 <!-- single social icon  -->
                 <div @mouseover="channel.hover = true" @mouseleave="channel.hover = false" class="inline-flex flex-col justify-center items-center gap-1 cursor-pointer _channels-container opacity-90 hover:opacity-100 transition duration-150 hover:grayscale-0" :class="{ 'grayscale': !isChannelEnabled(channel.id) }" @click.prevent="toggleChannel(channel.id)">
                     <span class="text-lg w-8 h-8 pt-0.5 rounded-full text-white flex items-center justify-center _icon-svg" :class="[channel.hover || isChannelEnabled(channel.id) ? channel.class : 'bg-gray-300']" x-html="getIcon(channel.id)">
                     </span>
                     <span class="text-xs text-center text-slate-600" x-text="channel.name"></span>

                     <template x-if="channel.enabled">
                         <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4" :class="{ 'text-blue-500' : isChannelEnabled(channel.id), 'opacity-10' : !isChannelEnabled(channel.id) }" viewBox="0 0 16 16">
                             <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                         </svg>
                     </template>

                     <template x-if="!channel.enabled">
                         <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-4 text-slate-300" viewBox="0 0 16 16">
                             <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                         </svg>
                     </template>

                 </div>
                 <!-- single icon ends  -->
             </template>

         </div>


         <div x-show="!filteredChannels.length" class="text-slate-400 text-center mt-4">
             <?php echo __('Not found <span class="italic text-blue-500" x-text="state.search_channels"></span>', 'wp-dark-mode'); ?>
         </div>

         <!-- more channel buttons  -->
         <div class="flex flex-between gap-3 my-6 justify-center text-xs">
             <a href="javascript:;" class="bg-transparent px-2 py-1 rounded-sm font-medium focus:outline-none text-blue-400 hover:ring-blue-600 ring-1 ring-blue-500 focus:text-blue-500 hover:bg-blue-50 inline-flex items-center gap-1 transition duration-150" @click.prevent="state.showAllChannels = !state.showAllChannels">
                 <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-3 transition duration-300" :class="{'rotate-180' : state.showAllChannels}" viewBox="0 0 16 16">
                     <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                 </svg>
                 <span x-text="state.showAllChannels ? ' <?php echo __('See less channels', 'wp-dark-mode'); ?>' : ' <?php echo __('See more channels', 'wp-dark-mode'); ?>'"></span>
             </a>
             <a href="javascript:;" x-show="isFree" class="bg-red-50 px-2 py-1 rounded-sm font-medium focus:outline-none focus:ring-red-400 text-red-600 ring-1 ring-red-200 hover:text-red-400 hover:opacity-75  transition duration-150" @click.prevent="showPromo"><?php echo __('Unlock all channels', 'wp-dark-mode'); ?></a>
         </div>

         <!-- customize channels  -->
         <div class="mt-8">
             <label class="font-semibold text-sm text-slate-700 cursor-pointer block mb-2  flex gap-2"><?php echo __('Manage channels', 'wp-dark-mode'); ?> <span class="wpdarkmode-tooltip" title="<?php echo __('Reorder your social channels. You can edit the channel label and device visibility for each. Drag channels to change their order.', 'wp-dark-mode'); ?>"></span></label>
             <div class="flex flex-col gap-2" dropzone="true">
                 <template x-for="channel in enabledChannels">
                     <div class="flex flex-col gap-2 w-80 relative" dropzone="true" draggable="true" @dragstart="state.draggingChannel = channel.id" @dragenter="handleDrag($event, channel.id)" @dragend="handleDrop($event, channel.id)">

                         <div class="flex items-center gap-4 w-full cursor-pointer _social-share-container inline" tabindex="0">

                             <span tabindex="1" class="text-slate-200 transition duration-100 h-full flex items-center justify-center text-2xl cursor-grab" :class="{'text-blue-600' : state.draggingChannel === channel.id }">

                                 <svg xmlns="http://www.w3.org/2000/svg" class="fill-current w-8" viewBox="0 0 16 16">
                                     <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                                 </svg> 

                             </span>

                             <div class="flex items-center bg-slate-200 _channels-container">
                                 <div class="bg-slate-600 text-white h-10 w-10 flex items-center justify-center text-base _icon-svg" :class="`_icon-${channel.id}`" x-html="getIcon(channel.id)">

                                 </div>
                                 <div class="text-sm h-full w-28 px-3 font-medium flex items-center focus:outline-none focus:ring focus:ring-blue-500 transition duration-100 h-10 w-full" x-text="channel.name" contenteditable="true" @input="channel.name = $event.target.innerText"></div>
                             </div>

                             <span @click.prevent="channel.visibility.mobile = !channel.visibility.mobile" class="bg-slate-200 h-10 w-11 flex items-center justify-center text-base transition duration-100" :class="channel.visibility.mobile ? ['text-blue-500'] : ['text-slate-300']" x-html="constant.devices.mobile.icon">

                             </span>

                             <span @click.prevent="channel.visibility.desktop = !channel.visibility.desktop" class="bg-slate-200 h-10 w-11 flex items-center justify-center text-base transition duration-100" :class="channel.visibility.desktop ? ['text-blue-500'] : ['text-slate-300']" x-html="constant.devices.desktop.icon">

                             </span>

                             <span @click.prevent="toggleChannel(channel.id)" class="bg-slate-200 text-slate-400 hover:text-red-600 transition duration-150 h-10 w-11 flex items-center justify-center text-base">
                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" class="fill-current w-6">
                                     <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                 </svg>
                             </span>

                         </div>

                         <!-- sort dropzone  -->
                         <div class="h-full w-full absolute bg-white shadow z-20 ring rounded-sm ring-blue-400 flex items-center justify-center text-center font-semibold tracking-wider" x-show="state.draggingChannel === channel.id" draggable="true">Drop here</div>
                     </div>
                 </template>
             </div>
         </div>

     </div>

 </section>