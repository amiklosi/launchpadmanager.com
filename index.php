<?php define('WEBPAGE', 'home');
   include 'header.php'; ?>
   
    <div class="content" id="wrapper">
      <article>
        <div class="intro"></div>
        
      
      	<h2 class="dark">Get the most out of Launchpad!</h2>
      	<p class="dark">
      		Delete, Rearrange, Group or Ungroup any of your Launchpad Icons, 
      		<br />or
      		simply put them into alphabetical order!
      		<a class="btn" href="features.php">Read More</a>
      	</p>
      </article><!--start article -->
      <aside>
        <hgroup>
          <center>
          <h1>
          Launchpad Manager          
          </h1>
          <p class='yosemite'><b>Big Sur and above</b></p>
          <p class='yosemite'>Intel and M1 chipset</p>
          <a class="yellow roundbutton downloadicon" href="download_yosemite.php">Download</a>
          <p class="gray">Please report problems and bugs <a href="contact.php">here</a>

            <hr/>
            <p class='yosemite'><b>Catalina and below: </b><a href="/appyos/1.0.10/LaunchpadManager.dmg">Download</a></p>


          </center>
        
        <h3>
      	 <?php echo number_format(intval(trim(file_get_contents('count.txt'))));?> downloads!
      	</h3>
        </hgroup>
        
	
        
        <br />
        <br />
      
      
     <div class="thumb"> 
      
       <br /><br /><br /><br />
       <br /><br />

 </aside>                 
 <br />
 </div>
  </div>
  
<?php include('footer.php')?>
