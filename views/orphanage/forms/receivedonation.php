<div class="w-full scrolling-auto">
                <form action="/orphanage/donation" method="post">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Receive Donation
              </h1>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Transaction Id</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Save The Children"
                  name="transId"
                  id="transId"
                  type="text"
                />
              </label>
              <label for="" class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Transaction Type</span>
                <select 
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                name="transType" id="transType">
                  <option value="airtel money">Airtel Money</option>
                  <option value="mpamba">Mpamba</option>
                </select>
              </label>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Sender Phone No:</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="xxxx-xxx-xxx"
                  name="senderPhone"
                  id="senderPhone"
                  type="text"
                />
              </label>
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Amount</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Save The Children"
                  name="amount"
                  id="amount"
                  type="text"
                />
              </label>
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