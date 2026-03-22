<?php define('WEBPAGE', 'home');
   include 'header.php'; ?>
   
    <div class="content" id="wrapper">

      <!-- AppGrid Hero -->
      <div class="ag-hero">
        <div class="ag-hero-inner">
          <div class="ag-hero-text">
            <p class="ag-label">From the developer of Launchpad Manager</p>
            <h1>AppGrid</h1>
            <p class="ag-sub">Apple removed Launchpad in macOS Tahoe. AppGrid brings it back — everything Launchpad Manager could do (delete, rearrange, group, alphabetical sort) and more, rebuilt for macOS Tahoe.</p>
            <div class="ag-buttons">
              <a class="ag-btn-primary" href="https://zekalogic.com/appgrid/app/download.php" onclick="posthog && posthog.capture('lm_download_direct');">Download — $25 Lifetime</a>
            </div>
            <p class="ag-note">Free core features · no subscription required · <a href="https://appgridmac.com" target="_blank">appgridmac.com</a></p>
          </div>
        </div>
      </div>

      <!-- Legacy Download -->
      <div class="ag-legacy">
        <p>Looking for the original Launchpad Manager? <a href="download_yosemite.php">Download here</a> (no longer updated — macOS Sequoia and below only) &nbsp;·&nbsp; <?php echo number_format(intval(trim(file_get_contents('count.txt'))));?> downloads</p>
      </div>

    </div>
  </div>
  
<?php include('footer.php')?>
