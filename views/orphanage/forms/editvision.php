<div class="w-full scrolling-auto">
                <form action="/orphanage/profile/edit" method="post">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Edit Vision
              </h1>
              <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Description</span>
                    <textarea name="vision" id="vision">
                        <?php echo $orphanage->vision?>
                    </textarea>
                    </label>
              <input type="hidden" name="type" value="vision" >
              <input type="hidden" name="orphanageId" value="<?php echo $orphanage->id ?>">
              <!-- You should use a button here, as the anchor is only used for the example  -->
              <button
                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                type="submit"
              >
                add
              </button>
            </form>
</div>