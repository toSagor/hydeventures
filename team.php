<?php
    $page_title = "Team";
    include 'template/header.php';
    
    // Active Team Member Infomration Query
    $sql_member = "SELECT * FROM team WHERE status='1'";
    $result_member = mysqli_query($con, $sql_member)or die(mysqli_error($con));
?>
<main id="page" class="container" role="main">
  <article class="sections" data-page-sections="5f2db1ee48f82716a2e5f3e8" id="sections">
    <section data-test="page-section" data-section-theme="white-bold" class='page-section layout-engine-section background-width--full-bleed content-width--wide horizontal-alignment--center vertical-alignment--middle white-bold' data-section-id="5f5a86698defe8727a81ceaa" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 60, "sectionTheme": "white-bold", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background">
      </div>
      <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); '>
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f5a86698defe8727a81ceaa">
            <div class="row sqs-row">
              <div class="col sqs-col-3 span-3">
                <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600137655685_13034">
                  <div class="sqs-block-content">&nbsp;</div>
                </div>
              </div>
              <div class="col sqs-col-6 span-6">
                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-5f5a866998733e5668bd9e6f">
                  <div class="sqs-block-content">
                    <h1 style="text-align:center;white-space:pre-wrap;">Our Team</h1>
                  </div>
                </div>
              </div>
              <div class="col sqs-col-3 span-3">
                <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600137655685_15254">
                  <div class="sqs-block-content">&nbsp;</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="bright-inverse" class='page-section layout-engine-section background-width--full-bleed content-width--wide horizontal-alignment--center vertical-alignment--middle bright-inverse' data-section-id="5f5a8697be9f1b5c6026f532" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 60, "sectionTheme": "bright-inverse", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background">
      </div>
      <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); ' >
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f5a8697be9f1b5c6026f532">
            <div class="row sqs-row">
              <?php if ($result_member): ?>
              <?php while ($memberList = mysqli_fetch_array($result_member)): ?>
              <div class="col sqs-col-4 span-4">
                <div class="sqs-block image-block sqs-block-image" data-block-type="5" id="block-yui_3_17_2_1_1599768143737_6770">
                  <div class="sqs-block-content">
                    <div class=" image-block-outer-wrapper layout-caption-hidden design-layout-inline combination-animation-site-default individual-animation-site-default individual-text-animation-site-default " data-test="image-block-inline-outer-wrapper" >
                      <figure class=" sqs-block-image-figure intrinsic " style="max-width:2000px;" >
                        <a class=" sqs-block-image-link " href="#">
                          <div style="padding-bottom:100%;" class=" image-block-wrapper has-aspect-ratio " data-animation-role="image" >
                            <img class="thumb-image" data-src="<?php echo baseUrl(); ?>upload/team_member/<?php echo $memberList['image']; ?>" data-image="<?php echo baseUrl(); ?>upload/team_member/<?php echo $memberList['image']; ?>" data-image-dimensions="2000x2000" data-image-focal-point="0.5,0.5" alt="<?php echo $memberList['name']; ?>" data-load="false" data-image-id="5f5fdd843284f64286f5d3c8" data-type="image" />
                          </div>
                        </a>
                      </figure>
                    </div>
                  </div>
                </div>
                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-yui_3_17_2_1_1599768143737_27596">
                  <div class="sqs-block-content">
                    <h4 style="text-align:center;white-space:pre-wrap;"><?php echo $memberList['name']; ?></h4>
                    <p style="text-align:center;white-space:pre-wrap;" class=""><?php echo $memberList['designation']; ?></p>
                    <p style="text-align:center;white-space:pre-wrap;" class=""><a href="#"><strong>Full Bio →</strong></a></p>
                  </div>
                </div>
              </div>
              <?php endwhile; ?>
              <?php endif; ?>  
            </div>
          </div>
        </div>
      </div>
    </section>
  </article>
</main>
<?php include 'template/footer.php'; ?>