<?php

$orphanage = Application::$app->session->getOrphanage();

?>

<div class="flex flex-col" >
    <div class='flex flex-col items-center ml-40 mr-40 mt-5 mb-5' style="border-radius: 1%;" >
        <div class="m-5 w-full flex flex-col items-center" >
            <div 
                class='bg-blue-800 border-white border-4 shadow-2xl' 
                style="border-radius: 100%; height: 15rem; width: 15rem; position: absolute; z-index: 4;" 
            >
            </div>
        </div>
        <div class='bg-teal-500 shadow-2xl p-5 mt-40 pt-20 w-full flex flex-col items-center' style="border-radius: 2%;">        
            <h1><?php echo $orphanage->name ?></h1>
            <h2><?php echo $orphanage->district ?></h2>
            <a
                href="/orphanage/map"
                class='block px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple'     
            >Map</a>
        </div>
    </div>
    <div class='flex flex-row justify-center' >
        <div class="m-5" style="width: 50%;">
            <div class='m-2 bg-teal-500 flex flex-col items-center shadow-2xl' style="border-radius: 2%;" >
                <h2 class=' bg-blue-200 p-2' style="border-radius: 2%; width: 90%;" >Contacts</h2>    
                <div class="flex flex-col w-full items-center">       
                    <button 
                        id="addContact"
                        class='block px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple'     
                    >add</button>
                    <?php if($contact->status): ?>
                    <ul class='w-full' >
                        <?php foreach($contact->records as $record): ?>
                        <li class="m-1 p-2 bg-blue-100 hover:bg-blue-300 flex flex-row justify-between">
                            <span><?php echo $record->number ?></span>
                            <span style="font-size: small;"><?php echo $record->name ?></span>
                            <span><i class="fa fas fa-edit"></i></span>
                        </li>
                        <?php endforeach;?>
                    </ul>
                    <?php else:?>
                        <?php echo $contact->message ?>
                    <?php endif;?>
                </div>    
            </div>
            
        </div>
        <div class="m-5" style="width: 50%;">
            <div class='m-2 bg-teal-500 flex flex-col items-center shadow-2xl' style="border-radius: 2%;" >
                <div class="flex flex-row justify-between bg-blue-200 p-2" style="border-radius: 2%; width: 90%;">
                    <h2>Mission</h2>    
                    <span id="edit-mission"><i class="fa fas fa-edit"></i></span>    
                </div>
                <div class='p-5' >
                    <?php 
                        $desc = new DOMDocument();
                        libxml_use_internal_errors(true);
                        $desc->loadHTML($orphanage->mission);
                        echo $desc->textContent;
                    ?>
                </div>
            </div>

            <div class='m-2 bg-teal-500 flex flex-col items-center shadow-2xl' style="border-radius: 2%;" >
                <div class="flex flex-row justify-between bg-blue-200 p-2" style="border-radius: 2%; width: 90%;">
                    <h2>Vision</h2>    
                    <span id="edit-vision"><i class="fa fas fa-edit"></i></span>    
                </div>
                <div class='p-5' >
                    <?php 
                        $desc = new DOMDocument();
                        libxml_use_internal_errors(true);
                        $desc->loadHTML($orphanage->vision);
                        echo $desc->textContent;
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="add-contact-form" style="position: fixed; z-index: 10; top: 10%; left: 35%;
            background-color: #4b88a2; display: none; width: 40%;" 
    class="p-10" >
          <?php include('../views/orphanage/forms/addcontact.php') ?>
</div>

<div id="edit-vision-form" style="position: absolute; z-index: 10; top: 10%; left: 10%;
            background-color: #4b88a2; display: none; width: 80%;" 
    class="p-10" >
          <?php include('../views/orphanage/forms/editvision.php') ?>
</div>

<div id="edit-mission-form" style="position: absolute; z-index: 10; top: 10%; left: 10%;
            background-color: #4b88a2; display: none; width: 80%;" 
    class="p-10" >
          <?php include('../views/orphanage/forms/editmission.php') ?>
</div>

<script>

  var menu = {

    init: () => {
      document.getElementById('addContact').onclick = menu.showAdd;
      document.getElementById('edit-vision').onclick = menu.showEditVision;
      document.getElementById('edit-mission').onclick = menu.showEditMission;
      document.getElementById('overlay').onclick = menu.close;

    },
    showAdd: () => {
      document.getElementById('overlay').style.display = 'block';
      document.getElementById('add-contact-form').style.display = 'block';
    },
    showEditMission: () => {
      document.getElementById('overlay').style.display = 'block';
      document.getElementById('edit-mission-form').style.display = 'block';
    },
    showEditVision: () => {
      document.getElementById('overlay').style.display = 'block';
      document.getElementById('edit-vision-form').style.display = 'block';
    },
    close: () => {
      document.getElementById('overlay').style.display = 'none';
      document.getElementById('add-contact-form').style.display = 'none';
      document.getElementById('edit-vision-form').style.display = 'none';
      document.getElementById('edit-mission-form').style.display = 'none';
    }
  }

  window.addEventListener("load", menu.init);

  $(document).ready(function(){

    $("#vision").richText();
    $("#mission").richText();

    });
</script>