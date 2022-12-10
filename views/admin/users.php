<div class="p-5" >
<!-- With actions -->
<div class="overflow-hidden rounded-lg shadow-xs" >
  <div class="overflow-x-auto">
    <?php if($result->status): ?>
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left uppercase border-b dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">username</th>
                      <th class="px-4 py-3">role</th>
                      <th class="px-4 py-3">Status</th>
                      <th class="px-4 py-3">email</th>
                      <th class="px-4 py-3">actions</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                  <?php foreach($result->records as $user ): ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                      <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                          <!-- Avatar with inset shadow -->
                          <!-- <div
                            class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                          > -->
                            <!-- <img
                              class="object-cover w-full h-full rounded-full"
                              src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                              alt=""
                              loading="lazy"
                            /> -->
                            <!-- <div
                              class="absolute inset-0 rounded-full shadow-inner"
                              aria-hidden="true"
                            ></div> -->
                          <!-- </div> -->
                          <div>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                              <?php echo $user->userName?>
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        <?php echo $user->role?>
                      </td>
                      <td class="px-4 py-3 text-xs">
                        <span
                          class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                        >
                        <?php echo $user->status?>
                        </span>
                      </td>
                      <td class="px-4 py-3 text-sm">
                        <?php echo $user->email?>
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                          <button
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Edit"
                          >
                            <svg
                              class="w-5 h-5"
                              aria-hidden="true"
                              fill="currentColor"
                              viewBox="0 0 20 20"
                            >
                              <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                              ></path>
                            </svg>
                          </button>
                          <button
                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                            aria-label="Delete"
                          >
                            <svg
                              class="w-5 h-5"
                              aria-hidden="true"
                              fill="currentColor"
                              viewBox="0 0 20 20"
                            >
                              <path
                                fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd"
                              ></path>
                            </svg>
                          </button>
                        </div>
                      </td>
                    </tr>
                <?php endforeach; ?>
                  </tbody>
                </table>
        <?php else: ?>
        <?php endif; ?>
        </div>
    </div>
</div>
<div id="plus-btn"
      class="flex"
      style="color: #fff; padding:.5rem; position: fixed; top: 85%; 
          left: 92.5%; border-radius: 50%; width: 5rem; justify-content: center;align-items:center ; 
          height: 5rem; background-color: #4b88a2">
  <i class="fas fa-2x fa-plus"></i>
</div>

<div id="add-user-form" style="position: fixed; z-index: 10; top: 10%; left: 35%;
            background-color: #4b88a2; display: none; width: 40%;" 
    class="p-10" >
          <?php include('../views/admin/forms/adduser.php') ?>
</div>

<script>

  var menu = {

    init: () => {
      document.getElementById('plus-btn').onclick = menu.showAdd;
      document.getElementById('overlay').onclick = menu.close;

    },
    showAdd: () => {
      document.getElementById('overlay').style.display = 'block';
      document.getElementById('add-user-form').style.display = 'block';
    },
    close: () => {
      document.getElementById('overlay').style.display = 'none';
      document.getElementById('add-user-form').style.display = 'none';
    }
  }

  window.addEventListener("load", menu.init);
</script>