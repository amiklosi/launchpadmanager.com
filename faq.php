<?php define('WEBPAGE', 'faq');
   include 'header.php'; ?>
   
    <div class="content" id="faq">
      <article>
        
        <h2 >FAQ </h2>

        <h3>Q: Why do applications reappear in Launchpad after I've deleted them?  	<br/><br />
        A: Unfortunately Apple haven't released any documentation concerning the inner workings of Launchpad so it's a mystery 
    	what method they use to determine whether an application should appear in Launchpad or not. That means there's
    	no guarantee that the layout will remain the same after you save it from Launchpad Manager. That's what <a href="help.php#saving">Save/Load layout</a>
    	feature are meant to remedy.</h3>
    	<br/>
        
        <h3>Q: I saved the layout on my laptop and tried to load it on my desktop but it didn't work!<br/><br />
        A: Saving and loading layout are designed to be performed on the same computer. For some people migrating between
        two computers will work as well, but if Launchpad decides (based on an unknown algorithm) that the database is corrupt
        it will regenerate the database.</h3>
    	<br/>

        <h3>Q: Will the app work in Mountain Lion?<br/><br />
        A: Yes it will! New features like managing Widgets have also been included and I'm adding new ones continuously.</h3>
    	<br/>


        <h3>Q: There's nothing useful in the free version! 	<br/><br />
        A: The free version allows you to remove items from Launchpad without uninstalling them - something you can't do from Launchpad.
    	Aside from that you are right, the free version is supposed to let you have a look and decide whether the application is worth
    	for you to buy it or not.</h3>
    	<br/>

    	<h3>Q: Can I have ... feature please? <br/><br />
    		A: I suggest you use the <a href="contact.php">Contact</a> form and ask for it. If a few people ask for the same feature I will probably
    		implement it in the near future.
    	</h3>
    	<br/>

    	<h3>Q: I found a bug!<br/><br />
    		A: Bug reports are more than welcome, please use the <a href="contact.php">Contact</a> form and describe what the problem is. I will fix
    		it as soon as possible.


      </article>
 </div>
  </div>
  
<?php include('footer.php')?>
