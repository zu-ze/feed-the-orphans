<div class="w-full scrolling-auto">
                <form action="/admin/orphanages" method="post">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Add Orphanage
              </h1>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Name</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Save The Children"
                  name="name"
                  id="name"
                  type="text"
                />
              </label>
              <label for="" class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Admin Username</span>
                <select 
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                name="adminId" id="adminId">
                <?php if( $users->status ): ?>
                  <?php foreach($users->records as $user ): ?>
                  <option value="<?php echo $user->userId ?>"><?php echo $user->userName?></option>
                  <?php endforeach;?>
                <?php else: ?>
                  <option value="0">$users->message</option>
                <?php endif;?>
                </select>
              </label>
              <!-- You should use a button here, as the anchor is only used for the example  -->
              <button
                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                type="submit"
              >
                add
              </button>
            </form>
            </div>