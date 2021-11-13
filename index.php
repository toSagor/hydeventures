<?php
    $page_title = "Home";
    include 'template/header.php';
    
    // Featured Company List
    $sql_company = "SELECT * FROM company WHERE status='1' AND is_featured='1'";
    $result_company = mysqli_query($con, $sql_company)or die(mysqli_error($con));
    
    // Featured Social Impact List
    $sql_social_impact = "SELECT * FROM social_impact WHERE status='1' AND is_featured='1' LIMIT 3";
    $result_social_impact = mysqli_query($con, $sql_social_impact)or die(mysqli_error($con));
    
    // Featured Content List
    $sql_content = "SELECT * FROM content WHERE status='1' AND is_featured='1' LIMIT 3";
    $result_content = mysqli_query($con, $sql_content)or die(mysqli_error($con));
?>
<main id="page" class="container" role="main">
  <article class="sections" data-page-sections="5f4faf17533b676cea60314f" id="sections">
    <section data-test="page-section" data-section-theme="white-bold" class='page-section layout-engine-section background-width--full-bleed horizontal-alignment--center vertical-alignment--middle white-bold' data-section-id="5f4faf17533b676cea603152" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 61, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--custom", "customContentWidth": 80, "sectionTheme": "white-bold", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 61vh;" >
      <div class="section-background">
      </div>
      <div class="content-wrapper" style='padding-top: calc(61vmax / 10); padding-bottom: calc(61vmax / 10); '>
        <div
          class="content"
          style="width: 80%;"
          >
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f4faf17533b676cea603152">
            <div class="row sqs-row">
              <div class="col sqs-col-12 span-12">
                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-35d9332f46ba141152bd">
                  <div class="sqs-block-content">
                    <p style="text-align:center;white-space:pre-wrap;" class="sqsrte-small"><strong>Our Mission</strong></p>
                    <h1 style="text-align:center;white-space:pre-wrap;">Coach and invest in entrepreneurial leaders building world-class, purpose-driven organizations</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="bright-inverse" class='page-section layout-engine-section background-width--full-bleed content-width--wide horizontal-alignment--center vertical-alignment--middle bright-inverse' data-section-id="5f5fc496b566627b641987b6" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 60, "sectionTheme": "bright-inverse", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background">
      </div>
      <div class="content-wrapper" style='padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10);'>
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f5fc496b566627b641987b6">
            <div class="row sqs-row">
              <div class="col sqs-col-3 span-3">
                <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600123827956_35492">
                  <div class="sqs-block-content">&nbsp;</div>
                </div>
              </div>
              <div class="col sqs-col-6 span-6">
                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-f6f3ac7d6766bcead1c1">
                  <div class="sqs-block-content">
                    <h4 style="text-align:center;white-space:pre-wrap;">&nbsp;The most important word in our mission is <strong>coach.</strong></h4>
                    <p style="text-align:center;white-space:pre-wrap;" class="">When we invest, it’s about more than the capital. We want to help develop the next generation of leaders, and in turn, help them realize their vision.</p>
                    <p style="text-align:center;white-space:pre-wrap;" class="">We believe it’s not just about your vision though, it’s also about your values; that doing well and doing good are not mutually exclusive; and that managing&nbsp;compassionately builds stronger teams and companies.</p>
                  </div>
                </div>
              </div>
              <div class="col sqs-col-3 span-3">
                <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600123827956_39060">
                  <div class="sqs-block-content">&nbsp;</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="bright-inverse" class='page-section layout-engine-section background-width--full-bleed content-width--wide horizontal-alignment--center vertical-alignment--middle bright-inverse' data-section-id="5f4faf33533b676cea6033b8" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 50, "sectionTheme": "bright-inverse", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background">
      </div>
      <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); ' >
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f4faf33533b676cea6033b8">
            <div class="row sqs-row">
              <div class="col sqs-col-12 span-12">
                <div class="sqs-block summary-v2-block sqs-block-summary-v2" data-block-json="&#123;&quot;hSize&quot;:null,&quot;floatDir&quot;:null,&quot;collectionId&quot;:&quot;5f4fa263ee09f02ebf068f11&quot;,&quot;design&quot;:&quot;autocolumns&quot;,&quot;headerText&quot;:&quot;Featured&quot;,&quot;textSize&quot;:&quot;large&quot;,&quot;pageSize&quot;:13,&quot;imageAspectRatio&quot;:&quot;1.5&quot;,&quot;columnWidth&quot;:423,&quot;gutter&quot;:26,&quot;listImageSize&quot;:30,&quot;listImageAlignment&quot;:&quot;left&quot;,&quot;slidesPerRow&quot;:3,&quot;textAlignment&quot;:&quot;left&quot;,&quot;showTitle&quot;:true,&quot;showThumbnail&quot;:true,&quot;showExcerpt&quot;:true,&quot;showReadMoreLink&quot;:false,&quot;showPrice&quot;:true,&quot;productQuickViewEnabled&quot;:false,&quot;showPastOrUpcomingEvents&quot;:&quot;upcoming&quot;,&quot;metadataPosition&quot;:&quot;below-content&quot;,&quot;primaryMetadata&quot;:&quot;none&quot;,&quot;secondaryMetadata&quot;:&quot;none&quot;,&quot;filter&quot;:&#123;&quot;categoryIds&quot;:null&#125;,&quot;autoCrop&quot;:true,&quot;lightbox&quot;:false,&quot;mixedContent&quot;:true,&quot;blockId&quot;:&quot;6170499568fc00e9cb0e&quot;&#125;" data-block-type="55" id="block-yui_3_17_2_1_1598994909916_7004">
                  <div class="sqs-block-content">
                    <div class=" summary-block-wrapper summary-block-collection-type-blog-single-column summary-block-setting-text-size-large summary-block-setting-text-align-left summary-block-setting-design-autocolumns summary-block-setting-design-list-thumbnail-left summary-block-setting-metadata-position-below-content summary-block-setting-primary-metadata-none summary-block-setting-secondary-metadata-none summary-block-setting-show-thumbnail summary-block-setting-show-title summary-block-setting-show-price summary-block-setting-show-excerpt sqs-gallery-design-autocolumns " >
                      <div class="summary-item-list-container sqs-gallery-container">
                        <header class="summary-block-header">
                          <!-- Collection Title -->
                          <div class="summary-heading" data-animation-role="content">
                            <span class="summary-header-text">Featured</span>
                          </div>
                          <!-- Carousel Nav -->
                          <div class="summary-carousel-pager sqs-gallery-controls" data-animation-role="content">
                            <span class="summary-carousel-pager-prev previous" tabindex="0" role="button" aria-label="Previous" ></span>
                            <span class="summary-carousel-pager-next next" tabindex="0" role="button" aria-label="Next"/>
                          </div>
                        </header>
                        <div class="summary-item-list sqs-gallery">
                          <?php if ($result_company): ?>
                          <?php while ($companyList = mysqli_fetch_array($result_company)): ?>
                          <div class=" summary-item summary-item-record-type-text sqs-gallery-design-autocolumns-slide summary-item-has-thumbnail summary-item-has-excerpt summary-item-has-author " >
                            <!-- Thumbnail -->
                            <div class="summary-thumbnail-outer-container">
                              <a href="companies.php" class=" summary-thumbnail-container sqs-gallery-image-container " data-title="Dylan Field, CEO and co-founder, Figma" data-description="" >
                                <div class="summary-thumbnail img-wrapper" data-animation-role="image">
                                  <!-- Main Image -->
                                  <img data-src="<?php echo baseUrl(); ?>upload/company_image/banner/<?php echo $companyList['banner'] ?>" data-image="<?php echo baseUrl(); ?>upload/company_image/banner/<?php echo $companyList['banner'] ?>" data-image-dimensions="1047x696" data-image-focal-point="0.5,0.5" alt="<?php echo $companyList['title'] ?>"  data-load="false" class="summary-thumbnail-image"/>
                                </div>
                              </a>
                              <!-- Products: Quick View -->
                            </div>
                            <div class="summary-content sqs-gallery-meta-container" data-animation-role="content">
                              <!-- Metadata (Above Title) -->
                              <div class="summary-metadata-container summary-metadata-container--above-title">
                                <div class="summary-metadata summary-metadata--primary">
                                </div>
                                <div class="summary-metadata summary-metadata--secondary">
                                </div>
                              </div>
                              <!-- Title -->
                              <div class="summary-title">
                                <a href="companies.php" class="summary-title-link"><?php echo $companyList['title'] ?></a>
                              </div>
                              <!-- Metadata (Below Title) -->
                              <div class="summary-metadata-container summary-metadata-container--below-title">
                                <div class="summary-metadata summary-metadata--primary">
                                </div>
                                <div class="summary-metadata summary-metadata--secondary">
                                </div>
                              </div>
                              <!-- Excerpt -->
                              <div class="summary-excerpt">
                                <p class="" style="white-space:pre-wrap;"><?php echo $companyList['detail'] ?></p>
                              </div>
                              <!-- Metadata (Below Content) -->
                              <div class="summary-metadata-container summary-metadata-container--below-content">
                                <div class="summary-metadata summary-metadata--primary">
                                </div>
                                <div class="summary-metadata summary-metadata--secondary">
                                </div>
                              </div>
                            </div>
                            <!-- End .summary-content -->
                          </div>
                          <!-- End .summary-item -->
                          <?php endwhile; ?>
                          <?php endif; ?>
                        </div>
                        <!-- End .summary-item-list -->
                      </div>
                      <!-- End .summary-item-list-container -->
                    </div>
                  </div>
                </div>
                <div class="sqs-block code-block sqs-block-code" data-block-type="23" id="block-yui_3_17_2_1_1600141275066_16384">
                  <div class="sqs-block-content">
                    <div id="about"></div>
                  </div>
                </div>
                <div class="sqs-block button-block sqs-block-button" data-block-type="53" id="block-yui_3_17_2_1_1600111734875_18606">
                  <div class="sqs-block-content">
                    <div class="sqs-block-button-container--center" data-animation-role="button" data-alignment="center" data-button-size="large">
                      <a href="companies.php" class="sqs-block-button-element--large sqs-block-button-element" >View All Companies</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="white-bold" class='page-section layout-engine-section background-width--full-bleed content-width--wide horizontal-alignment--center vertical-alignment--middle white-bold' data-section-id="5f4faf17533b676cea603158" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 60, "sectionTheme": "white-bold", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background">
      </div>
      <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); ' >
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f4faf17533b676cea603158">
            <div class="row sqs-row">
              <div class="col sqs-col-3 span-3">
                <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600123827956_19876">
                  <div class="sqs-block-content">&nbsp;</div>
                </div>
              </div>
              <div class="col sqs-col-6 span-6">
                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-16564c2c85e3570977e1">
                  <div class="sqs-block-content">
                    <h4 style="text-align:center;white-space:pre-wrap;">About Next Play Ventures</h4>
                    <p style="text-align:center;white-space:pre-wrap;" class="">After completing 11 years as CEO of LinkedIn and stepping into the role of executive chairman, <a href="#">Jeff Weiner</a><strong> </strong>founded Next Play Ventures to focus more on investing, coaching, and philanthropy. He's joined by <a href="#">Brian Rumao,</a> his chief of staff for the last seven years.</p>
                  </div>
                </div>
                <div class="sqs-block image-block sqs-block-image" data-aspect-ratio="69.17148362235068" data-block-type="5" id="block-d49b39626f9d1169fca4">
                  <div class="sqs-block-content">
                    <div class=" image-block-outer-wrapper layout-caption-hidden design-layout-inline combination-animation-site-default individual-animation-site-default individual-text-animation-site-default " data-test="image-block-inline-outer-wrapper" >
                      <figure class=" sqs-block-image-figure intrinsic " style="max-width:1811px;" >
                        <div style="padding-bottom:69.1714859008789%;" class=" image-block-wrapper has-aspect-ratio " data-animation-role="image" >
                          <noscript><img src="https://images.squarespace-cdn.com/content/v1/5f2da1110b971b4c6306ef1d/1599426428440-53II8C3RJGFJJN5P00R4/ke17ZwdGBToddI8pDm48kG37mv6NZWe8ng1Z4t6yhaR7gQa3H78H3Y0txjaiv_0fDoOvxcdMmMKkDsyUqMSsMWxHk725yiiHCCLfrh8O1z5QPOohDIaIeljMHgDF5CVlOqpeNLcJ80NK65_fV7S1UbRpwYS1MsNJrD_D4YIwI3cLNPoLmv9dbLFjNblAv3snfvSKcCiQDXJ8mOZZ-46MLw/Jeff+Weiner+%26+Brian+Rumao+–+Next+Play+Ventures+–+Next+Play+venture+capital+–+Venture+Capital+coaching" alt="Jeff Weiner &amp;amp; Brian Rumao – Next Play Ventures – Next Play venture capital – Venture Capital coaching" /></noscript>
                          <img class="thumb-image" data-src="https://images.squarespace-cdn.com/content/v1/5f2da1110b971b4c6306ef1d/1599426428440-53II8C3RJGFJJN5P00R4/ke17ZwdGBToddI8pDm48kG37mv6NZWe8ng1Z4t6yhaR7gQa3H78H3Y0txjaiv_0fDoOvxcdMmMKkDsyUqMSsMWxHk725yiiHCCLfrh8O1z5QPOohDIaIeljMHgDF5CVlOqpeNLcJ80NK65_fV7S1UbRpwYS1MsNJrD_D4YIwI3cLNPoLmv9dbLFjNblAv3snfvSKcCiQDXJ8mOZZ-46MLw/Jeff+Weiner+%26+Brian+Rumao+%E2%80%93+Next+Play+Ventures+%E2%80%93+Next+Play+venture+capital+%E2%80%93+Venture+Capital+coaching" data-image="https://images.squarespace-cdn.com/content/v1/5f2da1110b971b4c6306ef1d/1599426428440-53II8C3RJGFJJN5P00R4/ke17ZwdGBToddI8pDm48kG37mv6NZWe8ng1Z4t6yhaR7gQa3H78H3Y0txjaiv_0fDoOvxcdMmMKkDsyUqMSsMWxHk725yiiHCCLfrh8O1z5QPOohDIaIeljMHgDF5CVlOqpeNLcJ80NK65_fV7S1UbRpwYS1MsNJrD_D4YIwI3cLNPoLmv9dbLFjNblAv3snfvSKcCiQDXJ8mOZZ-46MLw/Jeff+Weiner+%26+Brian+Rumao+%E2%80%93+Next+Play+Ventures+%E2%80%93+Next+Play+venture+capital+%E2%80%93+Venture+Capital+coaching" data-image-dimensions="1811x1171" data-image-focal-point="0.5,0.5" alt="Jeff Weiner &amp;amp; Brian Rumao – Next Play Ventures – Next Play venture capital – Venture Capital coaching" data-load="false" data-image-id="5f554f7b746c776c6595c8d6" data-type="image" />
                        </div>
                      </figure>
                    </div>
                  </div>
                </div>
                <div class="sqs-block button-block sqs-block-button" data-block-type="53" id="block-5e72b6c557c4a87b9869">
                  <div class="sqs-block-content">
                    <div class="sqs-block-button-container--center" data-animation-role="button" data-alignment="center" data-button-size="large">
                      <a href="team.php" class="sqs-block-button-element--large sqs-block-button-element" >Meet Our Team</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col sqs-col-3 span-3">
                <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600123827956_22998">
                  <div class="sqs-block-content">&nbsp;</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="dark" class='page-section layout-engine-section background-width--full-bleed content-width--wide horizontal-alignment--center vertical-alignment--middle dark' data-section-id="5f4faf17533b676cea60315c" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 60, "sectionTheme": "dark", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background">
      </div>
      <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); ' >
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f4faf17533b676cea60315c">
            <div class="row sqs-row">
              <div class="col sqs-col-3 span-3">
                <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600123746629_28595">
                  <div class="sqs-block-content">&nbsp;</div>
                </div>
              </div>
              <div class="col sqs-col-6 span-6">
                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-7df37619eb0e177ae091">
                  <div class="sqs-block-content">
                    <p style="text-align:center;white-space:pre-wrap;" class="">The name for Next Play Ventures was inspired by one of the most successful coaches of the modern era, Duke Men’s Basketball Coach Mike Krzyzewski. Every time the team goes up and down the court and completes a sequence, either offensively or defensively, Coach K says the exact same thing: “Next play." He doesn’t want the team lingering too long on what just took place — whether positive or negative — but rather focused on the present moment and prepared for what's to come.&nbsp;</p>
                    <p style="text-align:center;white-space:pre-wrap;" class="">While building LinkedIn, we often invoked “Next play” as our unofficial mantra. It’s about taking a moment to reflect, celebrate the wins, and learn from our mistakes, before moving forward to what’s ahead.</p>
                    <p style="text-align:center;white-space:pre-wrap;" class="sqsrte-small"><strong>Next Play ventures is our next play. </strong></p>
                    <p style="text-align:center;white-space:pre-wrap;" class="sqsrte-small"><strong>We look forward to joining you on yours.</strong></p>
                  </div>
                </div>
              </div>
              <div class="col sqs-col-3 span-3">
                <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600123746629_31995">
                  <div class="sqs-block-content">&nbsp;</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="white-bold" class='page-section layout-engine-section background-width--full-bleed content-width--wide horizontal-alignment--center vertical-alignment--middle white-bold' data-section-id="5f5ff347a1ccb235dca7cca8" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 60, "sectionTheme": "white-bold", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background">
      </div>
      <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); ' >
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f5ff347a1ccb235dca7cca8">
            <div class="row sqs-row">
              <div class="col sqs-col-12 span-12">
                <div class="row sqs-row">
                  <div class="col sqs-col-3 span-3">
                    <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600123449172_14810">
                      <div class="sqs-block-content">&nbsp;</div>
                    </div>
                  </div>
                  <div class="col sqs-col-6 span-6">
                    <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-yui_3_17_2_1_1600123449172_14079">
                      <div class="sqs-block-content">
                        <h3 style="text-align:center;white-space:pre-wrap;">Social Impact</h3>
                        <p style="text-align:center;white-space:pre-wrap;" class="">We invest our time and resources in&nbsp;organizations committed to expanding the world’s collective wisdom and compassion.</p>
                        <p style="text-align:center;white-space:pre-wrap;" class="">Our core belief is that people with equal talent deserve equal access to opportunity. We strive to close the network gap and create opportunities for underserved communities.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col sqs-col-3 span-3">
                    <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600123449172_18309">
                      <div class="sqs-block-content">&nbsp;</div>
                    </div>
                  </div>
                </div>
                <div class="sqs-block summary-v2-block sqs-block-summary-v2" data-block-json="&#123;&quot;collectionId&quot;:&quot;5f33195edfbefb5c1214234d&quot;,&quot;design&quot;:&quot;carousel&quot;,&quot;headerText&quot;:&quot;Featured&quot;,&quot;textSize&quot;:&quot;large&quot;,&quot;pageSize&quot;:6,&quot;imageAspectRatio&quot;:&quot;1.5&quot;,&quot;columnWidth&quot;:270,&quot;gutter&quot;:60,&quot;listImageSize&quot;:30,&quot;listImageAlignment&quot;:&quot;left&quot;,&quot;slidesPerRow&quot;:3,&quot;textAlignment&quot;:&quot;left&quot;,&quot;showTitle&quot;:true,&quot;showThumbnail&quot;:true,&quot;showExcerpt&quot;:false,&quot;showReadMoreLink&quot;:false,&quot;showPrice&quot;:true,&quot;productQuickViewEnabled&quot;:false,&quot;showPastOrUpcomingEvents&quot;:&quot;upcoming&quot;,&quot;metadataPosition&quot;:&quot;below-content&quot;,&quot;primaryMetadata&quot;:&quot;none&quot;,&quot;secondaryMetadata&quot;:&quot;none&quot;,&quot;filter&quot;:&#123;&quot;categoryIds&quot;:null&#125;,&quot;autoCrop&quot;:true,&quot;lightbox&quot;:false,&quot;mixedContent&quot;:true,&quot;blockId&quot;:&quot;ce284e9005e528187ab0&quot;&#125;" data-block-type="55" id="block-ca5c4838de479dda33e4">
                  <div class="sqs-block-content">
                    <div class=" summary-block-wrapper summary-block-collection-type-blog-single-column summary-block-setting-text-size-large summary-block-setting-text-align-left summary-block-setting-design-carousel summary-block-setting-design-list-thumbnail-left summary-block-setting-metadata-position-below-content summary-block-setting-primary-metadata-none summary-block-setting-secondary-metadata-none summary-block-setting-show-thumbnail summary-block-setting-show-title summary-block-setting-show-price summary-block-setting-hide-excerpt sqs-gallery-design-carousel " >
                      <div class="summary-item-list-container sqs-gallery-container">
                        <header class="summary-block-header">
                          <!-- Collection Title -->
                          <div class="summary-heading" data-animation-role="content">
                            <span class="summary-header-text">Featured</span>
                          </div>
                          <!-- Carousel Nav -->
                          <div class="summary-carousel-pager sqs-gallery-controls" data-animation-role="content">
                            <span class="summary-carousel-pager-prev previous" tabindex="0" role="button" aria-label="Previous"/>
                            <span class="summary-carousel-pager-next next" tabindex="0" role="button" aria-label="Next"/>
                          </div>
                        </header>
                        <div class="summary-item-list sqs-gallery">
                          <?php if ($result_social_impact): ?>
                          <?php while ($socialImpactList = mysqli_fetch_array($result_social_impact)): ?>
                          <div class=" summary-item summary-item-record-type-text sqs-gallery-design-carousel-slide summary-item-has-thumbnail summary-item-has-excerpt summary-item-has-tags summary-item-has-author " >
                            <!-- Thumbnail -->
                            <div class="summary-thumbnail-outer-container">
                              <a href="social-impact.php" class=" summary-thumbnail-container sqs-gallery-image-container " data-title="Concrete Rose Capital and Foundation" data-description="" >
                                <div class="summary-thumbnail img-wrapper" data-animation-role="image">
                                  <!-- Main Image -->
                                  <img data-src="<?php echo baseUrl(); ?>upload/social_impact/banner/<?php echo $socialImpactList['banner'] ?>" data-image="<?php echo baseUrl(); ?>upload/social_impact/banner/<?php echo $socialImpactList['banner'] ?>" data-image-dimensions="593x433" data-image-focal-point="0.5,0.5" alt="<?php echo $socialImpactList['title'] ?>"  data-load="false" class="summary-thumbnail-image"/>
                                </div>
                              </a>
                              <!-- Products: Quick View -->
                            </div>
                            <div class="summary-content sqs-gallery-meta-container" data-animation-role="content">
                              <!-- Metadata (Above Title) -->
                              <div class="summary-metadata-container summary-metadata-container--above-title">
                                <div class="summary-metadata summary-metadata--primary">
                                </div>
                                <div class="summary-metadata summary-metadata--secondary">
                                </div>
                              </div>
                              <!-- Title -->
                              <div class="summary-title">
                                <a href="social-impact.php" class="summary-title-link"><?php echo $socialImpactList['title'] ?></a>
                              </div>
                              <!-- Metadata (Below Title) -->
                              <div class="summary-metadata-container summary-metadata-container--below-title">
                                <div class="summary-metadata summary-metadata--primary">
                                </div>
                                <div class="summary-metadata summary-metadata--secondary">
                                </div>
                              </div>
                              <!-- Metadata (Below Content) -->
                              <div class="summary-metadata-container summary-metadata-container--below-content">
                                <div class="summary-metadata summary-metadata--primary">
                                </div>
                                <div class="summary-metadata summary-metadata--secondary">
                                </div>
                              </div>
                            </div>
                            <!-- End .summary-content -->
                          </div>
                          <!-- End .summary-item -->
                          <?php endwhile; ?>
                          <?php endif; ?>
                        </div>
                        <!-- End .summary-item-list -->
                      </div>
                      <!-- End .summary-item-list-container -->
                    </div>
                  </div>
                </div>
                <div class="sqs-block button-block sqs-block-button" data-block-type="53" id="block-yui_3_17_2_1_1600746370459_16491">
                  <div class="sqs-block-content">
                    <div class="sqs-block-button-container--center" data-animation-role="button" data-alignment="center" data-button-size="large">
                      <a href="social-impact.php" class="sqs-block-button-element--large sqs-block-button-element" >View All Organizations</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="bright-inverse" class='page-section layout-engine-section background-width--full-bleed content-width--wide horizontal-alignment--center vertical-alignment--middle bright-inverse' data-section-id="5f5ff36bf68e240044210e08" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 50, "sectionTheme": "bright-inverse", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background">
      </div>
      <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); ' >
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f5ff36bf68e240044210e08">
            <div class="row sqs-row">
              <div class="col sqs-col-12 span-12">
                <div class="row sqs-row">
                  <div class="col sqs-col-3 span-3">
                    <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600123746629_17232">
                      <div class="sqs-block-content">&nbsp;</div>
                    </div>
                  </div>
                  <div class="col sqs-col-6 span-6">
                    <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-yui_3_17_2_1_1600123746629_16250">
                      <div class="sqs-block-content">
                        <h3 style="text-align:center;white-space:pre-wrap;">Content</h3>
                        <p style="text-align:center;white-space:pre-wrap;" class="">Our perspectives on leadership, productivity, and culture.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col sqs-col-3 span-3">
                    <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_1_1600123746629_21585">
                      <div class="sqs-block-content">&nbsp;</div>
                    </div>
                  </div>
                </div>
                <div class="sqs-block summary-v2-block sqs-block-summary-v2" data-block-json="&#123;&quot;collectionId&quot;:&quot;5f343a52779f0079da860716&quot;,&quot;design&quot;:&quot;carousel&quot;,&quot;headerText&quot;:&quot;Featured&quot;,&quot;textSize&quot;:&quot;large&quot;,&quot;pageSize&quot;:6,&quot;imageAspectRatio&quot;:&quot;1.5&quot;,&quot;columnWidth&quot;:270,&quot;gutter&quot;:60,&quot;listImageSize&quot;:30,&quot;listImageAlignment&quot;:&quot;left&quot;,&quot;slidesPerRow&quot;:3,&quot;textAlignment&quot;:&quot;left&quot;,&quot;showTitle&quot;:true,&quot;showThumbnail&quot;:true,&quot;showExcerpt&quot;:false,&quot;showReadMoreLink&quot;:false,&quot;showPrice&quot;:true,&quot;productQuickViewEnabled&quot;:false,&quot;showPastOrUpcomingEvents&quot;:&quot;upcoming&quot;,&quot;metadataPosition&quot;:&quot;above-title&quot;,&quot;primaryMetadata&quot;:&quot;cats&quot;,&quot;secondaryMetadata&quot;:&quot;none&quot;,&quot;filter&quot;:&#123;&quot;categoryIds&quot;:null,&quot;featured&quot;:true&#125;,&quot;autoCrop&quot;:true,&quot;lightbox&quot;:false,&quot;mixedContent&quot;:true,&quot;blockId&quot;:&quot;afc5ac72a7d578ce57be&quot;&#125;" data-block-type="55" id="block-69343b7338ae9bbb2a6b">
                  <div class="sqs-block-content">
                    <div class=" summary-block-wrapper summary-block-collection-type-blog-single-column summary-block-setting-text-size-large summary-block-setting-text-align-left summary-block-setting-design-carousel summary-block-setting-design-list-thumbnail-left summary-block-setting-metadata-position-above-title summary-block-setting-primary-metadata-cats summary-block-setting-secondary-metadata-none summary-block-setting-show-thumbnail summary-block-setting-show-title summary-block-setting-show-price summary-block-setting-hide-excerpt sqs-gallery-design-carousel " >
                      <div class="summary-item-list-container sqs-gallery-container">
                        <header class="summary-block-header">
                          <!-- Collection Title -->
                          <div class="summary-heading" data-animation-role="content">
                            <span class="summary-header-text">Featured</span>
                          </div>
                          <!-- Carousel Nav -->
                          <div class="summary-carousel-pager sqs-gallery-controls" data-animation-role="content">
                            <span class="summary-carousel-pager-prev previous" tabindex="0" role="button" aria-label="Previous"/>
                            <span class="summary-carousel-pager-next next" tabindex="0" role="button" aria-label="Next"/>
                          </div>
                        </header>
                        <div class="summary-item-list sqs-gallery">
                          <?php if ($result_content): ?>
                          <?php while ($contentList = mysqli_fetch_array($result_content)): ?>  
                          <div class=" summary-item summary-item-record-type-text sqs-gallery-design-carousel-slide summary-item-has-thumbnail summary-item-has-excerpt summary-item-has-cats summary-item-has-tags summary-item-has-author">
                            <!-- Thumbnail -->
                            <div class="summary-thumbnail-outer-container">
                              <a href="<?php echo $contentList['link'] ?>" class=" summary-thumbnail-container sqs-gallery-image-container " data-title="Vision to Values: A Complete Guide " data-description="" >
                                <div class="summary-thumbnail img-wrapper" data-animation-role="image">
                                  <!-- Main Image -->
                                  <img data-src="<?php echo baseUrl(); ?>upload/content/<?php echo $contentList['banner'] ?>" data-image="<?php echo baseUrl(); ?>upload/content/<?php echo $contentList['banner'] ?>" data-image-dimensions="2500x1410" data-image-focal-point="0.4446309604993967,0.28574086131522647" alt="<?php echo $contentList['title'] ?>"  data-load="false" class="summary-thumbnail-image"/>
                                </div>
                              </a>
                              <!-- Products: Quick View -->
                            </div>
                            <div class="summary-content sqs-gallery-meta-container" data-animation-role="content">
                              <!-- Metadata (Above Title) -->
                              <div class="summary-metadata-container summary-metadata-container--above-title">
                                <div class="summary-metadata summary-metadata--primary">
                                  <!-- Categories -->
                                    <span class="summary-metadata-item summary-metadata-item--cats"><a href="<?php echo $contentList['link'] ?>"><?php echo $contentList['type'] ?></a></span>
                                </div>
                                <div class="summary-metadata summary-metadata--secondary">
                                </div>
                              </div>
                              <!-- Title -->
                              <div class="summary-title">
                                <a href="<?php echo $contentList['link'] ?>" class="summary-title-link"><?php echo $contentList['title'] ?></a>
                              </div>
                              <!-- Metadata (Below Title) -->
                              <div class="summary-metadata-container summary-metadata-container--below-title">
                                <div class="summary-metadata summary-metadata--primary">
                                  <!-- Categories -->
                                  <span class="summary-metadata-item summary-metadata-item--cats"><a href="<?php echo $contentList['link'] ?>"><?php echo $contentList['type'] ?></a></span>
                                </div>
                                <div class="summary-metadata summary-metadata--secondary">
                                </div>
                              </div>
                              <!-- Metadata (Below Content) -->
                              <div class="summary-metadata-container summary-metadata-container--below-content">
                                <div class="summary-metadata summary-metadata--primary">
                                  <!-- Categories -->
                                  <span class="summary-metadata-item summary-metadata-item--cats"><a href="<?php echo $contentList['link'] ?>"><?php echo $contentList['type'] ?></a></span>
                                </div>
                                <div class="summary-metadata summary-metadata--secondary">
                                </div>
                              </div>
                            </div>
                            <!-- End .summary-content -->
                          </div>
                          <!-- End .summary-item -->
                          <?php endwhile; ?>
                          <?php endif; ?>
                        </div>
                        <!-- End .summary-item-list -->
                      </div>
                      <!-- End .summary-item-list-container -->
                    </div>
                  </div>
                </div>
                <div class="sqs-block button-block sqs-block-button" data-block-type="53" id="block-yui_3_17_2_1_1600746370459_17720">
                  <div class="sqs-block-content">
                    <div class="sqs-block-button-container--center" data-animation-role="button" data-alignment="center" data-button-size="large">
                      <a href="content.php" class="sqs-block-button-element--large sqs-block-button-element" >View All Content</a>
                    </div>
                  </div>
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

