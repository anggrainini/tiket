<link rel="stylesheet" href="<?php echo base_url(); ?>assetsges/css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assetsges/css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assetsges/css/layout.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assetsges/css/cssmenu.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assetsges/css/pagination-styles.css" type="text/css">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assetsges/images/kepala.ico" type="image/x-icon" />
    <link href='http://fonts.googleapis.com/css?family=Adamina' rel='stylesheet' type='text/css'> 
    <link href="<?php echo base_url(); ?>assetsges/css/bootstrap.min.css" rel="stylesheet">  
    <link href="<?php echo base_url(); ?>assetsges/css/thumbnail-gallery.css" rel="stylesheet">
   <script src="<?php echo base_url(); ?>assetsges/js/jquery-1.6.3.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assetsges/js/cufon-yui.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assetsges/js/cufon-replace.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assetsges/js/Lobster_13_400.font.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assetsges/js/NewsGoth_BT_400.font.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assetsges/js/FF-cash.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assetsges/js/easyTooltip.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assetsges/js/script.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assetsges/js/bgSlider.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assetsges/js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assetsges/js/tms-0.3.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assetsges/js/tms_presets.js" type="text/javascript"></script>
   <script src="<?php echo base_url(); ?>assetsges/js/cssmenu.js"></script> 

<?php if($this->form_validation->run() === TRUE)
{
    $success="Success, Your Message has been sent";
}else
{
    $success='';
}
;?>

<?php if($guest==NULL){
    $result='Currently, There is No Messages :(';
    }
    else{
    $result='';
      }  ?>

  <body id="page6">
    <div id="bgSlider"></div>
    <div></div>
    <div class="extra">
      <div class="inner">
            <div class="main">
                <section id="content">
                    <div class="indent">
                        <div class="wrapper">
                            <article class="col-1">
                                <div class="indent-left">
                                <br />
                                  <br />
                                  
                                  <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>web/home">Home</a></li>
      <li class="active">About</li>
     </ol>
                                    <h4>Guestbook</h4>
                                    <div class="p3">
                                    <br />
                                   <?php $tmp= array('id' => 'contact-form');?>
                                    <?php echo form_open("web/insert", $tmp);?>
                                            <fieldset>
                                             <input type="hidden" name="id_guest" id="id_guest">
                                                <input type="hidden" name="datetime" id="datetime">
                                                  <label><span class="text-form">Full Name:</span><input name="name" type="text" placeholder="Insert Full Name" /></label>    
                                                  <label><span class="text-form">E-mail:</span><input name="email" type="text" placeholder="Insert Email"/></label>                               
                                                  <div class="wrapper">
                                                    <div class="text-form" >Message:</div>
                                                    <div class="extra-wrap">
                                                        <textarea name="comment" placeholder="Your Message Here"></textarea>
                                                        <div class="clear"></div>
                                                        <div class="buttons">
                                                        <button class="button-2" type="reset">Reset</button>
                                                        <button class="button-2" type="submit">Submit</button>
                                                        </div> 
                                                            <?php echo form_close(); ?>
                                                    </div>
                                                  </div>                            
                                            </fieldset>                     
                                        </form>
                                    </div>
                                </div>
                                <div class="bg">
                                    <div class="padding">
                                        <h3>Guestbook Messages</h3>
                                        <br />
                                        <h5><?php echo $result;?></h5>
                                        <?php foreach ($guest as $row){ ?>
                                        <table>
                                            <tr>
                                                <td>From</td>
                                                <td>:</td>
                                                <td><?php echo $row->name; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Date Posted</td>
                                                <td>:</td>
                                                <td><?php echo $row->datetime; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Message</td>
                                                <td>:</td>
                                                <td><?php echo $row->comment; ?></td>
                                            </tr>
                                        </table>
                                        <hr />
                                        <br />
                                            <?php }?>
                                </div>
                            </article>
                            <article class="col-2">
                                <h3 class="border-bot indent-bot">Status Message</h3>
                                  <?php echo validation_errors(); ?>    <strong><?php echo $success; ?><br /></strong>


                                  <br />
                                  <br />
                                  <br />
                                  <br />
                                <figure><img width="240" height="180" src="<?php echo base_url(); ?>assets2/images/logopss.jpg" alt="" /></figure>
                                
                                </div>

                            </article>
                        </div>
                    </div>
                </section>
                <div class="block"></div>
            </div>
        </div>
    </div>