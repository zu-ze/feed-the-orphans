<?php 
  $orphanage = Application::$app->session->getOrphanage();
?>        
        <!-- Events Panel -->
        <div id="Events" style="padding: 2rem;">
          <div id="cal-wrap">
            <div style="width: 100%;" >
              <!-- (A) PERIOD SELECTOR -->
              <div id="cal-date">
                <select id="cal-mth"></select>
                <select id="cal-yr"></select>
              </div>

              <!-- (B) CALENDAR -->
              <div id="cal-container"></div>
            </div>
    
          </div>
        </div>
        <!-- End Events Panel -->
        </div>

<div id="plus-btn"
      class="flex ninja"
      style="color: #fff; padding:.5rem; position: fixed; top: 85%; 
          left: 92.5%; border-radius: 50%; width: 5rem; justify-content: center;align-items:center ; 
          height: 5rem; background-color: #4b88a2">
  <i class="fas fa-2x fa-plus"></i>
</div>

<div id="add-event-form" class="ninja" style="position: absolute; z-index: 10; top: 10%; left: 20%; width: 75%;" >
          <?php include('../views/orphanage/forms/addevent.php') ?>
</div>
<script async src="/vendor/calendar/calendar.js"></script>
<script>
      var menu = {

      init: () => {
        document.getElementById('plus-btn').onclick = menu.showAdd;
        document.getElementById('overlay').onclick = menu.close;

      },
      showAdd: () => {
        document.getElementById('overlay').style.display = 'block';
        document.getElementById('add-event-form').setAttribute('class', '');
      },
      close: () => {
        document.getElementById('overlay').style.display = 'none';
        document.getElementById('add-event-form').setAttribute('class', 'ninja');
      }
      }

      window.addEventListener("load", menu.init);

      $(document).ready(function(){

        $("#evt-details").richText();
    });
</script>