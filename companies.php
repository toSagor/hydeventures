<?php 
    $page_title = "Companies";
    include 'template/header.php';
    
    // Active Company Infomration Query
    $sql_company = "SELECT * FROM company WHERE status='1'";
    $result_company = mysqli_query($con, $sql_company)or die(mysqli_error($con));
?>
<main id="page" class="container" role="main">
  <article class="sections" data-page-sections="5f594a990ee6494b77119119" id="sections">
    <section data-test="page-section" data-section-theme="white-bold" class='page-section layout-engine-section background-width--full-bleed horizontal-alignment--center vertical-alignment--middle white-bold' data-section-id="5f594a990ee6494b7711911c" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--custom", "customContentWidth": 100, "sectionTheme": "white-bold", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background">
      </div>
      <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); ' >
        <div class="content" style="width: 100%;">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f594a990ee6494b7711911c">
            <div class="row sqs-row">
              <div class="col sqs-col-12 span-12">
                <div class="row sqs-row">
                  <div class="col sqs-col-2 span-2">
                    <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600137207493_3593">
                      <div class="sqs-block-content">&nbsp;</div>
                    </div>
                  </div>
                  <div class="col sqs-col-8 span-8">
                    <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-c55159beabdc98f81b7a">
                      <div class="sqs-block-content">
                        <h1 style="text-align:center;white-space:pre-wrap;">Companies</h1>
                        <p style="text-align:center;white-space:pre-wrap;" class="">We invest in and coach entrepreneurs who are committed to building world-class, purpose-driven organizations. We focus on early-stage (pre-seed, seed, and series A) and also selectively consider later stage growth investments.</p>
                        <p style="text-align:center;white-space:pre-wrap;" class="">Sector focus areas include B2B / enterprise software, financial tech, consumer apps, health and wellness and education. We are interested in productivity software and virtual work, direct-to-consumer / e-commerce, SaaS, and data and AI/ML-powered platforms.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col sqs-col-2 span-2">
                    <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600137207493_4741">
                      <div class="sqs-block-content">&nbsp;</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="dark" class='page-section gallery-section full-bleed-section background-width--full-bleed section-height--medium content-width--wide horizontal-alignment--center vertical-alignment--middle dark' data-section-id="5f594ac7f0b87e6355f920b5" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--medium", "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "sectionTheme": "dark", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" >
      <div class="section-background">
      </div>
      <div class="content-wrapper">
        <div class="content">
          <div class="gallery gallery-section-wrapper" style="min-height: 100px;">
            <div class="gallery" style="min-height: 100px;">
              <!-- Gallery Grid -->
              <div class="gallery-grid gallery-grid--layout-grid" data-controller="GalleryGrid" data-section-id="5f594ac7f0b87e6355f920b5" data-animation="site-default" data-lightbox="" data-width="inset" data-aspect-ratio="four-three" data-columns="5" data-gutter="40" data-props='{ "aspectRatio": "four-three", "scrollAnimation": "site-default", "gutter": 40, "numColumns": 5, "width": "inset", "lightboxEnabled": false }' data-show-captions="false" >
                
                <div class="gallery-grid-wrapper">
                  <?php if ($result_company): ?>
                  <?php while ($companyList = mysqli_fetch_array($result_company)): ?>
                  <figure class="gallery-grid-item has-clickthrough">
                    <div class="gallery-grid-item-wrapper" data-animation-role="image">
                      <a href="<?php echo $companyList['site_link'] ?>" target="_blank" rel="noopener" class="gallery-grid-image-link" data-no-animation>
                      <img data-src="<?php echo baseUrl(); ?>upload/company_image/logo/<?php echo $companyList['logo'] ?>" data-image="<?php echo baseUrl(); ?>upload/company_image/logo/<?php echo $companyList['logo'] ?>" data-image-dimensions="720x405" data-image-focal-point="0.5,0.5" alt="<?php echo $companyList['title'] ?>"  data-load="false" />
                      </a>
                    </div>
                  </figure>
                  <?php endwhile; ?>
                  <?php endif; ?>
                </div>       
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </article>
</main>
<?php include 'template/footer.php'; ?>