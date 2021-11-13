      <script type="text/javascript">
        const firstSection = document.querySelector('.page-section');
        const header = document.querySelector('.header');
        const mobileOverlayNav = document.querySelector('.header-menu');
        const sectionBackground = firstSection ? firstSection.querySelector('.section-background') : null;
        const headerHeight = header ? header.getBoundingClientRect().height : 0;
        const firstSectionHasBackground = firstSection ? firstSection.className.indexOf('has-background') >= 0 : false;
        const isFirstSectionInset = firstSection ? firstSection.className.indexOf('background-width--inset') >= 0 : false;
        const isLayoutEngineSection = firstSection ? firstSection.className.indexOf('layout-engine-section') >= 0 : false;

        if (firstSection) {
          firstSection.style.paddingTop = headerHeight + 'px';
        }
        if (sectionBackground && isLayoutEngineSection) {
          if (isFirstSectionInset) {
            sectionBackground.style.top = headerHeight + 'px';
          } else {
            sectionBackground.style.top = '';
          }
        }
        //# sourceURL=headerPositioning.js
      </script>
      <footer class="sections" id="footer-sections" data-footer-sections>
        <section data-test="page-section" data-section-theme="light" class='page-section layout-engine-section background-width--full-bleed section-height--custom content-width--wide horizontal-alignment--center vertical-alignment--middle light' data-section-id="5f2da1130b971b4c6306ef61" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 17, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 100, "sectionTheme": "light", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 17vh;" >
          <div class="section-background">
          </div>
          <div
            class="content-wrapper"
            style='
            padding-top: calc(17vmax / 10); padding-bottom: calc(17vmax / 10);
            '
            >
            <div
              class="content"
              >
              <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f2da1130b971b4c6306ef61">
                <div class="row sqs-row">
                  <div class="col sqs-col-12 span-12">
                    <div class="sqs-block button-block sqs-block-button" data-block-type="53" id="block-yui_3_17_2_1_1597516457055_21825">
                      <div class="sqs-block-content">
                        <div class="sqs-block-button-container--center" data-animation-role="button" data-alignment="center" data-button-size="large">
                          <a href="contact.php" class="sqs-block-button-element--large sqs-block-button-element" >Contact</a>
                        </div>
                      </div>
                    </div>
                    <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-yui_3_17_2_1_1597448308844_22422">
                      <div class="sqs-block-content">
                        <p style="text-align:center;white-space:pre-wrap;" class="sqsrte-small"><?php echo $site_footer_info; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </footer>
    </div>
    <script defer="defer" src="static1.squarespace.com/static/vta/5c5a519771c10ba3470d8101/scripts/site-bundle.b62953dd9082847b3e9f9b4b48106dd0.js" type="text/javascript"></script>
    <script id="extendedEditorScript">
      //This script handles additional formatting in Text Block (Extended Editor), do not remove if have such blocks on site
      if (window.self !== window.top && window.top.document.querySelector('html.squarespace-damask')) {if (!document.getElementById('extended-editor-scrypt')) {window.__extendedEditorLoaded = window.top.__extendedEditorLoaded = true;Y.Get.js('assets.squarewebsites.org/custom-editor/custom-editor-admin.min77e6.js?time=' + (new Date().getTime() + '').substr(0, 7), function(err, tx) {if (err) {console.log('Error loading Extended Editor Script: ' + err[0].error, 'error');return;}tx && tx.nodes[0].setAttribute('id', 'extended-editor-scrypt');});}}
    </script><script type="text/javascript" data-sqs-type="imageloader-bootstrapper">(function() {if(window.ImageLoader) { window.ImageLoader.bootstrap({}, document); }})();</script>
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="display:none" data-usage="social-icons-svg">
      <symbol id="linkedin-unauth-icon" viewBox="0 0 64 64">
        <path d="M20.4,44h5.4V26.6h-5.4V44z M23.1,18c-1.7,0-3.1,1.4-3.1,3.1c0,1.7,1.4,3.1,3.1,3.1 c1.7,0,3.1-1.4,3.1-3.1C26.2,19.4,24.8,18,23.1,18z M39.5,26.2c-2.6,0-4.4,1.4-5.1,2.8h-0.1v-2.4h-5.2V44h5.4v-8.6 c0-2.3,0.4-4.5,3.2-4.5c2.8,0,2.8,2.6,2.8,4.6V44H46v-9.5C46,29.8,45,26.2,39.5,26.2z"/>
      </symbol>
      <symbol id="linkedin-unauth-mask" viewBox="0 0 64 64">
        <path d="M0,0v64h64V0H0z M25.8,44h-5.4V26.6h5.4V44z M23.1,24.3c-1.7,0-3.1-1.4-3.1-3.1c0-1.7,1.4-3.1,3.1-3.1 c1.7,0,3.1,1.4,3.1,3.1C26.2,22.9,24.8,24.3,23.1,24.3z M46,44h-5.4v-8.4c0-2,0-4.6-2.8-4.6c-2.8,0-3.2,2.2-3.2,4.5V44h-5.4V26.6 h5.2V29h0.1c0.7-1.4,2.5-2.8,5.1-2.8c5.5,0,6.5,3.6,6.5,8.3V44z"/>
      </symbol>
      <symbol id="twitter-unauth-icon" viewBox="0 0 64 64">
        <path d="M48,22.1c-1.2,0.5-2.4,0.9-3.8,1c1.4-0.8,2.4-2.1,2.9-3.6c-1.3,0.8-2.7,1.3-4.2,1.6 C41.7,19.8,40,19,38.2,19c-3.6,0-6.6,2.9-6.6,6.6c0,0.5,0.1,1,0.2,1.5c-5.5-0.3-10.3-2.9-13.5-6.9c-0.6,1-0.9,2.1-0.9,3.3 c0,2.3,1.2,4.3,2.9,5.5c-1.1,0-2.1-0.3-3-0.8c0,0,0,0.1,0,0.1c0,3.2,2.3,5.8,5.3,6.4c-0.6,0.1-1.1,0.2-1.7,0.2c-0.4,0-0.8,0-1.2-0.1 c0.8,2.6,3.3,4.5,6.1,4.6c-2.2,1.8-5.1,2.8-8.2,2.8c-0.5,0-1.1,0-1.6-0.1c2.9,1.9,6.4,2.9,10.1,2.9c12.1,0,18.7-10,18.7-18.7 c0-0.3,0-0.6,0-0.8C46,24.5,47.1,23.4,48,22.1z"/>
      </symbol>
      <symbol id="twitter-unauth-mask" viewBox="0 0 64 64">
        <path d="M0,0v64h64V0H0z M44.7,25.5c0,0.3,0,0.6,0,0.8C44.7,35,38.1,45,26.1,45c-3.7,0-7.2-1.1-10.1-2.9 c0.5,0.1,1,0.1,1.6,0.1c3.1,0,5.9-1,8.2-2.8c-2.9-0.1-5.3-2-6.1-4.6c0.4,0.1,0.8,0.1,1.2,0.1c0.6,0,1.2-0.1,1.7-0.2 c-3-0.6-5.3-3.3-5.3-6.4c0,0,0-0.1,0-0.1c0.9,0.5,1.9,0.8,3,0.8c-1.8-1.2-2.9-3.2-2.9-5.5c0-1.2,0.3-2.3,0.9-3.3 c3.2,4,8.1,6.6,13.5,6.9c-0.1-0.5-0.2-1-0.2-1.5c0-3.6,2.9-6.6,6.6-6.6c1.9,0,3.6,0.8,4.8,2.1c1.5-0.3,2.9-0.8,4.2-1.6 c-0.5,1.5-1.5,2.8-2.9,3.6c1.3-0.2,2.6-0.5,3.8-1C47.1,23.4,46,24.5,44.7,25.5z"/>
      </symbol>
    </svg>
  </body>
</html>