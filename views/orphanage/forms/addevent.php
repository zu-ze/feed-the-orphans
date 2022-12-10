<div class="w-full scrolling-auto" >
                <form id="cal-event" style="background-color: #4b88a2" class="p-5" action="/orphanage/calendar" method="post">
              <h1 id="evt-head"
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Add Event
              </h1>
            <div class="flex flex-row ju">
                <div class="flex flex-col p-5" style="width: 50%;">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Title</span>
                        <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Independence day"
                        name="title"
                        id="title"
                        type="text"
                        />
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Date</span>
                        <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Jane Doe"
                        name="evt-date"
                        id="evt-date"
                        type="date"
                        />
                    </label>
                </div>
                <div class="flex-flex-col" style="width: 50%;">
                    <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Description</span>
                    <textarea name="evt-details" id="evt-details"></textarea>
                    </label>
                    <!-- You should use a button here, as the anchor is only used for the example  -->
                    <button
                    class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    type="submit"
                    >
                    add
                    </button>
                </div>
            </div>
              <input type="hidden" name="orphanageId" value="<?php echo $orphanage->id ?>">
              <input id="evt-close" type="button" value="Close"/>
                <input id="evt-del" type="button" value="Delete"/>
                <input id="evt-save" type="button" value="Save"/>
            </form>
            </div>