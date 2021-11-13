<?php 
    $page_title = "Contents";
    include 'template/header.php';
    
    // Leadership Content List
    $sql_content_leadership = "SELECT * FROM content WHERE category='1' AND status='1'";
    $result_content_leadership = mysqli_query($con, $sql_content_leadership)or die(mysqli_error($con));
    
    // Productivity Content List
    $sql_content_productivity = "SELECT * FROM content WHERE category='2' AND status='1'";
    $result_content_productivity = mysqli_query($con, $sql_content_productivity)or die(mysqli_error($con));
    
    // Content Content List
    $sql_content_culture = "SELECT * FROM content WHERE category='3' AND status='1'";
    $result_content_culture = mysqli_query($con, $sql_content_culture)or die(mysqli_error($con));
?>
<main id="page" class="container" role="main">
  <article class="sections" data-page-sections="5f2db1f985eaed1daa4c6978" id="sections">
    <section data-test="page-section" data-section-theme="white-bold" class='page-section layout-engine-section background-width--full-bleed content-width--medium horizontal-alignment--center vertical-alignment--middle white-bold' data-section-id="5f5fc53b5dcee615c16d1c70" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--medium", "customContentWidth": 78, "sectionTheme": "white-bold", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background"></div>
      <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); ' >
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f5fc53b5dcee615c16d1c70">
            <div class="row sqs-row">
              <div class="col sqs-col-12 span-12">
                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-5f5a58eb1a45ed3daa87f440">
                  <div class="sqs-block-content">
                    <h1 style="text-align:center;white-space:pre-wrap;">Content</h1>
                    <p style="text-align:center;white-space:pre-wrap;" class="">We aim to share the experiences, knowledge, and insight we’ve gained over our careers. Here you will find a collection of articles, courses, videos, and interviews that articulate our perspective.</p>
                  </div>
                </div>
                <div class="row sqs-row">
                  <div class="col sqs-col-4 span-4">
                    <div class="sqs-block button-block sqs-block-button" data-block-type="53" id="block-36a21918d2c3f9f3c855">
                      <div class="sqs-block-content">
                        <div class="sqs-block-button-container--center" data-animation-role="button" data-alignment="center" data-button-size="medium">
                          <a href="#leadership" class="sqs-block-button-element--medium sqs-block-button-element" >Leadership</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col sqs-col-4 span-4">
                    <div class="sqs-block button-block sqs-block-button" data-block-type="53" id="block-70563f8cb862b5b292be">
                      <div class="sqs-block-content">
                        <div class="sqs-block-button-container--center" data-animation-role="button" data-alignment="center" data-button-size="medium">
                          <a href="#productivity" class="sqs-block-button-element--medium sqs-block-button-element" >Productivity</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col sqs-col-4 span-4">
                    <div class="sqs-block button-block sqs-block-button" data-block-type="53" id="block-a4926fa84c537aa962fa">
                      <div class="sqs-block-content">
                        <div class="sqs-block-button-container--center" data-animation-role="button" data-alignment="center" data-button-size="medium">
                          <a href="#culture" class="sqs-block-button-element--medium sqs-block-button-element" >Culture</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="" class='page-section layout-engine-section background-width--full-bleed section-height--small horizontal-alignment--center vertical-alignment--middle has-background ' data-section-id="5f5a792890a8be18f987ea85" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "backgroundImage": { "id": "5f69c77ce8fce359cbff009b", "recordType": 2, "addedOn": 1600767868340, "updatedOn": 1600767878544, "workflowState": 1, "publishOn": 1600767868340, "authorId": "5886122f46c3c44ae822e42d", "systemDataId": "1600767872414-BHTV3KCDIHXGCYADEJZC", "systemDataVariants": "2500x373,100w,300w,500w,750w,1000w,1500w,2500w", "systemDataSourceType": "PNG", "filename": "Next Play Ventures – Next Play venture capital – Venture Capital coaching.png", "mediaFocalPoint": { "x": 0.5, "y": 0.5, "source": 3 }, "colorData": { "topLeftAverage": "f5f5f5", "topRightAverage": "b8b9ba", "bottomLeftAverage": "c5c7cf", "bottomRightAverage": "c0c1c2", "centerAverage": "a2a4ac", "suggestedBgColor": "f5f5f5" }, "urlId": "s4miviqdg22o3l04eonyfniakpwp5o", "title": "", "body": null, "likeCount": 0, "commentCount": 0, "publicCommentCount": 0, "commentState": 2, "unsaved": false, "author": { "id": "5886122f46c3c44ae822e42d", "displayName": "Bob Lawson", "firstName": "Bob", "lastName": "Lawson", "avatarUrl": "https://static1.squarespace.com/static/images/5e5ecd0dc0019119c52124cb/300w", "websiteUrl": "http://www.sustainabledigital.com", "bio": "<p>Website development, training, and consulting services for nonprofit organizations and creative entrepreneurs.<\/p>", "avatarAssetUrl": "https://static1.squarespace.com/static/images/5e5ecd0dc0019119c52124cb/300w" }, "assetUrl": "https://images.squarespace-cdn.com/content/v1/5f2da1110b971b4c6306ef1d/1600767872414-BHTV3KCDIHXGCYADEJZC/ke17ZwdGBToddI8pDm48kDirBYjS6ucGc6Ht1bLMaRgUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYwL8IeDg6_3B-BRuF4nNrNcQkVuAT7tdErd0wQFEGFSnD8TomhNnlexeie9N576tQOJRuVqheJb0OOoOxEJ2gM_ZqX-Y0d3hlM_7cyvTm6Gzg/Next+Play+Ventures+%E2%80%93+Next+Play+venture+capital+%E2%80%93+Venture+Capital+coaching.png", "contentType": "image/png", "items": [ ], "pushedServices": { }, "pendingPushedServices": { }, "recordTypeLabel": "image", "originalSize": "2500x373" }, "imageOverlayOpacity": 0.0, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--small", "customSectionHeight": 10, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--custom", "customContentWidth": 50, "sectionTheme": "", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" >
      <div class="section-background">
        <img alt="" data-src="https://images.squarespace-cdn.com/content/v1/5f2da1110b971b4c6306ef1d/1600767872414-BHTV3KCDIHXGCYADEJZC/ke17ZwdGBToddI8pDm48kDirBYjS6ucGc6Ht1bLMaRgUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYwL8IeDg6_3B-BRuF4nNrNcQkVuAT7tdErd0wQFEGFSnD8TomhNnlexeie9N576tQOJRuVqheJb0OOoOxEJ2gM_ZqX-Y0d3hlM_7cyvTm6Gzg/Next+Play+Ventures+%E2%80%93+Next+Play+venture+capital+%E2%80%93+Venture+Capital+coaching.png" data-image="https://images.squarespace-cdn.com/content/v1/5f2da1110b971b4c6306ef1d/1600767872414-BHTV3KCDIHXGCYADEJZC/ke17ZwdGBToddI8pDm48kDirBYjS6ucGc6Ht1bLMaRgUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYwL8IeDg6_3B-BRuF4nNrNcQkVuAT7tdErd0wQFEGFSnD8TomhNnlexeie9N576tQOJRuVqheJb0OOoOxEJ2gM_ZqX-Y0d3hlM_7cyvTm6Gzg/Next+Play+Ventures+%E2%80%93+Next+Play+venture+capital+%E2%80%93+Venture+Capital+coaching.png" data-image-dimensions="2500x373" data-image-focal-point="0.5,0.5" alt="Next Play Ventures – Next Play venture capital – Venture Capital coaching.png"  data-load="false" />
        <div data-controller="SectionBackgroundOverlayController" data-image-overlay-opacity="0" class="section-background-overlay"></div>
      </div>
      <div class="content-wrapper">
        <div class="content" style="width: 50%;">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f5a792890a8be18f987ea85">
            <div class="row sqs-row">
              <div class="col sqs-col-12 span-12">
                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-5f5a79281bfbcb7d07311071">
                  <div class="sqs-block-content">
                    <p class="" style="white-space:pre-wrap;">&nbsp;</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="bright-inverse" class='page-section layout-engine-section background-width--full-bleed content-width--wide horizontal-alignment--center vertical-alignment--middle bright-inverse' data-section-id="5f5a592101e6767e4ab12355" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 50, "sectionTheme": "bright-inverse", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
        <div class="section-background"></div>
        <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); ' >
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f5a592101e6767e4ab12355">
            <div class="row sqs-row">
              <div class="col sqs-col-12 span-12">
                <div class="row sqs-row">
                  <div class="col sqs-col-11 span-11">
                    <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-yui_3_17_2_1_1599764929512_8529">
                      <div class="sqs-block-content">
                        <h1 style="white-space:pre-wrap;">Leadership</h1>
                      </div>
                    </div>
                  </div>
                  <div class="col sqs-col-1 span-1">
                    <div class="sqs-block code-block sqs-block-code" data-block-type="23" id="block-yui_3_17_2_1_1600139319570_16471">
                      <div class="sqs-block-content">
                        <div id="leadership"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="sqs-block summary-v2-block sqs-block-summary-v2" data-block-json="&#123;&quot;hSize&quot;:null,&quot;floatDir&quot;:null,&quot;collectionId&quot;:&quot;5f343a52779f0079da860716&quot;,&quot;design&quot;:&quot;autogrid&quot;,&quot;headerText&quot;:&quot;Featured&quot;,&quot;textSize&quot;:&quot;medium&quot;,&quot;pageSize&quot;:30,&quot;imageAspectRatio&quot;:&quot;1.5&quot;,&quot;columnWidth&quot;:402,&quot;gutter&quot;:60,&quot;listImageSize&quot;:30,&quot;listImageAlignment&quot;:&quot;left&quot;,&quot;slidesPerRow&quot;:3,&quot;textAlignment&quot;:&quot;left&quot;,&quot;showTitle&quot;:true,&quot;showThumbnail&quot;:false,&quot;showExcerpt&quot;:true,&quot;showReadMoreLink&quot;:false,&quot;showPrice&quot;:true,&quot;productQuickViewEnabled&quot;:false,&quot;showPastOrUpcomingEvents&quot;:&quot;upcoming&quot;,&quot;metadataPosition&quot;:&quot;above-title&quot;,&quot;primaryMetadata&quot;:&quot;tags&quot;,&quot;secondaryMetadata&quot;:&quot;none&quot;,&quot;filter&quot;:&#123;&quot;categoryIds&quot;:null,&quot;category&quot;:&quot;Leadership&quot;&#125;,&quot;autoCrop&quot;:true,&quot;lightbox&quot;:false,&quot;mixedContent&quot;:true,&quot;blockId&quot;:&quot;927d36090407e8b15785&quot;&#125;" data-block-type="55" id="block-yui_3_17_2_1_1599756558629_4996">
                  <div class="sqs-block-content">
                    <div class=" summary-block-wrapper summary-block-collection-type-blog-single-column summary-block-setting-text-size-medium summary-block-setting-text-align-left summary-block-setting-design-autogrid summary-block-setting-design-list-thumbnail-left summary-block-setting-metadata-position-above-title summary-block-setting-primary-metadata-tags summary-block-setting-secondary-metadata-none summary-block-setting-show-title summary-block-setting-show-price summary-block-setting-show-excerpt sqs-gallery-design-autogrid " >
                      <div class="summary-item-list-container sqs-gallery-container">
                        <header class="summary-block-header">
                          <!-- Collection Title -->
                          <div class="summary-heading" data-animation-role="content">
                            <span class="summary-header-text">Featured</span>
                          </div>
                          <!-- Carousel Nav -->
                          <div class="summary-carousel-pager sqs-gallery-controls" data-animation-role="content">
                            <span class="summary-carousel-pager-prev previous" tabindex="0" role="button" aria-label="Previous"/></span>
                            <span class="summary-carousel-pager-next next" tabindex="0" role="button" aria-label="Next" ></span>
                          </div>
                        </header>
                        <div class="summary-item-list sqs-gallery">
                            <?php if ($result_content_leadership): ?>
                            <?php while ($conLidList = mysqli_fetch_array($result_content_leadership)): ?> 
                            <div class="summary-item summary-item-record-type-text sqs-gallery-design-autogrid-slide summary-item-has-thumbnail summary-item-has-excerpt summary-item-has-cats summary-item-has-tags summary-item-has-author">
                              <div class="summary-content sqs-gallery-meta-container" data-animation-role="content">
                                <!-- Metadata (Above Title) -->
                                <div class="summary-metadata-container summary-metadata-container--above-title">
                                  <div class="summary-metadata summary-metadata--primary">
                                    <!-- Tags -->
                                    <span class="summary-metadata-item summary-metadata-item--tags"><a href="<?php echo $conLidList['link'] ?>"><?php echo $conLidList['type'] ?></a></span>
                                  </div>
                                  <div class="summary-metadata summary-metadata--secondary"></div>
                                </div>
                                <!-- Title -->
                                <div class="summary-title">
                                  <a href="<?php echo $conLidList['link'] ?>" class="summary-title-link"><?php echo $conLidList['title'] ?></a>
                                </div>
                              </div>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="" class='page-section layout-engine-section background-width--full-bleed section-height--small content-width--wide horizontal-alignment--center vertical-alignment--middle has-background ' data-section-id="5f5a7aa3f042ea3152f379d5" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "backgroundImage": { "id": "5f69c7ab77b3211fc2bb939e", "recordType": 2, "addedOn": 1600767915096, "updatedOn": 1600767930227, "workflowState": 1, "publishOn": 1600767915096, "authorId": "5886122f46c3c44ae822e42d", "systemDataId": "1600767919264-SQVLCZ1R36LYKKN8Y2Y0", "systemDataVariants": "2500x371,100w,300w,500w,750w,1000w,1500w,2500w", "systemDataSourceType": "PNG", "filename": "Next Play Ventures – Venture Capital coaching – Next Play venture capital.png", "mediaFocalPoint": { "x": 0.5, "y": 0.5, "source": 3 }, "colorData": { "topLeftAverage": "e9e8e8", "topRightAverage": "8a848b", "bottomLeftAverage": "ececeb", "bottomRightAverage": "8b868f", "centerAverage": "e5e0dc", "suggestedBgColor": "e9e8e8" }, "urlId": "g7unekzfu5djlmo9vfwaxza7bd3tga", "title": "", "body": null, "likeCount": 0, "commentCount": 0, "publicCommentCount": 0, "commentState": 2, "unsaved": false, "author": { "id": "5886122f46c3c44ae822e42d", "displayName": "Bob Lawson", "firstName": "Bob", "lastName": "Lawson", "avatarUrl": "https://static1.squarespace.com/static/images/5e5ecd0dc0019119c52124cb/300w", "websiteUrl": "http://www.sustainabledigital.com", "bio": "<p>Website development, training, and consulting services for nonprofit organizations and creative entrepreneurs.<\/p>", "avatarAssetUrl": "https://static1.squarespace.com/static/images/5e5ecd0dc0019119c52124cb/300w" }, "assetUrl": "https://images.squarespace-cdn.com/content/v1/5f2da1110b971b4c6306ef1d/1600767919264-SQVLCZ1R36LYKKN8Y2Y0/ke17ZwdGBToddI8pDm48kEIJaYSpJkREqRvnGL9O6tQUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYwL8IeDg6_3B-BRuF4nNrNcQkVuAT7tdErd0wQFEGFSnBBf8uge0b7CDzLZj79dGlQ0CtiyvTcrCV5tQ5cfWYrig9La7dMrI3xzqcQ8cJrQ4Q/Next+Play+Ventures+%E2%80%93+Venture+Capital+coaching+%E2%80%93+Next+Play+venture+capital.png", "contentType": "image/png", "items": [ ], "pushedServices": { }, "pendingPushedServices": { }, "recordTypeLabel": "image", "originalSize": "2500x371" }, "imageOverlayOpacity": 0.0, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--small", "customSectionHeight": 10, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 50, "sectionTheme": "", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" >
      <div class="section-background">
        <img alt="" data-src="https://images.squarespace-cdn.com/content/v1/5f2da1110b971b4c6306ef1d/1600767919264-SQVLCZ1R36LYKKN8Y2Y0/ke17ZwdGBToddI8pDm48kEIJaYSpJkREqRvnGL9O6tQUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYwL8IeDg6_3B-BRuF4nNrNcQkVuAT7tdErd0wQFEGFSnBBf8uge0b7CDzLZj79dGlQ0CtiyvTcrCV5tQ5cfWYrig9La7dMrI3xzqcQ8cJrQ4Q/Next+Play+Ventures+%E2%80%93+Venture+Capital+coaching+%E2%80%93+Next+Play+venture+capital.png" data-image="https://images.squarespace-cdn.com/content/v1/5f2da1110b971b4c6306ef1d/1600767919264-SQVLCZ1R36LYKKN8Y2Y0/ke17ZwdGBToddI8pDm48kEIJaYSpJkREqRvnGL9O6tQUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYwL8IeDg6_3B-BRuF4nNrNcQkVuAT7tdErd0wQFEGFSnBBf8uge0b7CDzLZj79dGlQ0CtiyvTcrCV5tQ5cfWYrig9La7dMrI3xzqcQ8cJrQ4Q/Next+Play+Ventures+%E2%80%93+Venture+Capital+coaching+%E2%80%93+Next+Play+venture+capital.png" data-image-dimensions="2500x371" data-image-focal-point="0.5,0.5" alt="Next Play Ventures – Venture Capital coaching – Next Play venture capital.png"  data-load="false" />
        <div data-controller="SectionBackgroundOverlayController" data-image-overlay-opacity="0" class="section-background-overlay"></div>
      </div>
      <div class="content-wrapper">
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f5a7aa3f042ea3152f379d5">
            <div class="row sqs-row">
              <div class="col sqs-col-12 span-12">
                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-5af4f66e1a1c4e7fd196">
                  <div class="sqs-block-content">
                    <p class="" style="white-space:pre-wrap;">&nbsp;</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="white-bold" class='page-section layout-engine-section background-width--full-bleed content-width--wide horizontal-alignment--center vertical-alignment--middle white-bold' data-section-id="5f5a7b37604a0f005e71e1a0" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 50, "sectionTheme": "white-bold", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background"></div>
      <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); ' >
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f5a7b37604a0f005e71e1a0">
            <div class="row sqs-row">
              <div class="col sqs-col-12 span-12">
                <div class="row sqs-row">
                  <div class="col sqs-col-11 span-11">
                    <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-cfdf1853ef5e53a7dd1b">
                      <div class="sqs-block-content">
                        <h1 style="white-space:pre-wrap;">Productivity</h1>
                      </div>
                    </div>
                  </div>
                  <div class="col sqs-col-1 span-1">
                    <div class="sqs-block code-block sqs-block-code" data-block-type="23" id="block-yui_3_17_2_1_1600139319570_37083">
                      <div class="sqs-block-content">
                        <div id="productivity"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="sqs-block summary-v2-block sqs-block-summary-v2" data-block-json="&#123;&quot;collectionId&quot;:&quot;5f343a52779f0079da860716&quot;,&quot;design&quot;:&quot;autogrid&quot;,&quot;headerText&quot;:&quot;Featured&quot;,&quot;textSize&quot;:&quot;medium&quot;,&quot;pageSize&quot;:30,&quot;imageAspectRatio&quot;:&quot;1.5&quot;,&quot;columnWidth&quot;:402,&quot;gutter&quot;:60,&quot;listImageSize&quot;:30,&quot;listImageAlignment&quot;:&quot;left&quot;,&quot;slidesPerRow&quot;:3,&quot;textAlignment&quot;:&quot;left&quot;,&quot;showTitle&quot;:true,&quot;showThumbnail&quot;:false,&quot;showExcerpt&quot;:true,&quot;showReadMoreLink&quot;:false,&quot;showPrice&quot;:true,&quot;productQuickViewEnabled&quot;:false,&quot;showPastOrUpcomingEvents&quot;:&quot;upcoming&quot;,&quot;metadataPosition&quot;:&quot;above-title&quot;,&quot;primaryMetadata&quot;:&quot;tags&quot;,&quot;secondaryMetadata&quot;:&quot;none&quot;,&quot;filter&quot;:&#123;&quot;categoryIds&quot;:null,&quot;category&quot;:&quot;Productivity&quot;&#125;,&quot;autoCrop&quot;:true,&quot;lightbox&quot;:false,&quot;mixedContent&quot;:true,&quot;blockId&quot;:&quot;927d36090407e8b15785&quot;&#125;" data-block-type="55" id="block-e4ec7953837264e29476">
                  <div class="sqs-block-content">
                    <div class=" summary-block-wrapper summary-block-collection-type-blog-single-column summary-block-setting-text-size-medium summary-block-setting-text-align-left summary-block-setting-design-autogrid summary-block-setting-design-list-thumbnail-left summary-block-setting-metadata-position-above-title summary-block-setting-primary-metadata-tags summary-block-setting-secondary-metadata-none summary-block-setting-show-title summary-block-setting-show-price summary-block-setting-show-excerpt sqs-gallery-design-autogrid " >
                      <div class="summary-item-list-container sqs-gallery-container">
                        <header class="summary-block-header">
                          <!-- Collection Title -->
                          <div class="summary-heading" data-animation-role="content">
                            <span class="summary-header-text">Featured</span>
                          </div>
                          <!-- Carousel Nav -->
                          <div class="summary-carousel-pager sqs-gallery-controls" data-animation-role="content">
                            <span class="summary-carousel-pager-prev previous" tabindex="0" role="button" aria-label="Previous" ></span>
                            <span class="summary-carousel-pager-next next" tabindex="0" role="button" aria-label="Next" ></span>
                          </div>
                        </header>
                        <div class="summary-item-list sqs-gallery">
                            <?php if ($result_content_productivity): ?>
                            <?php while ($conProList = mysqli_fetch_array($result_content_productivity)): ?> 
                            <div class=" summary-item summary-item-record-type-text sqs-gallery-design-autogrid-slide summary-item-has-thumbnail summary-item-has-excerpt summary-item-has-cats summary-item-has-tags summary-item-has-author " >
                              <div class="summary-content sqs-gallery-meta-container" data-animation-role="content">
                                <!-- Metadata (Above Title) -->
                                <div class="summary-metadata-container summary-metadata-container--above-title">
                                  <div class="summary-metadata summary-metadata--primary">
                                    <!-- Tags -->
                                    <span class="summary-metadata-item summary-metadata-item--tags"><a href="<?php echo $conProList['link'] ?>"><?php echo $conProList['type'] ?></a></span>
                                  </div>
                                  <div class="summary-metadata summary-metadata--secondary"></div>
                                </div>
                                <!-- Title -->
                                <div class="summary-title">
                                  <a href="<?php echo $conProList['link'] ?>" class="summary-title-link"><?php echo $conProList['title'] ?></a>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="" class='page-section layout-engine-section background-width--full-bleed section-height--small content-width--wide horizontal-alignment--center vertical-alignment--middle has-background ' data-section-id="5f5a7b11f042ea3152f397c5" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "backgroundImage": { "id": "5f69c867372e390ebb69b0cf", "recordType": 2, "addedOn": 1600768103558, "updatedOn": 1600768116229, "workflowState": 1, "publishOn": 1600768103558, "authorId": "5886122f46c3c44ae822e42d", "systemDataId": "1600768109028-OPRD5DISSJJODGIY2BJK", "systemDataVariants": "2500x372,100w,300w,500w,750w,1000w,1500w,2500w", "systemDataSourceType": "PNG", "filename": "Next Play venture capital – Next Play Ventures – Venture Capital coaching.png", "mediaFocalPoint": { "x": 0.5, "y": 0.5, "source": 3 }, "colorData": { "topLeftAverage": "cecac8", "topRightAverage": "c1c4c8", "bottomLeftAverage": "949baa", "bottomRightAverage": "f5f6f6", "centerAverage": "c9cace", "suggestedBgColor": "cecac8" }, "urlId": "t0xy2lqc7360fiu7ht0futbnvnjp4y", "title": "", "body": null, "likeCount": 0, "commentCount": 0, "publicCommentCount": 0, "commentState": 2, "unsaved": false, "author": { "id": "5886122f46c3c44ae822e42d", "displayName": "Bob Lawson", "firstName": "Bob", "lastName": "Lawson", "avatarUrl": "https://static1.squarespace.com/static/images/5e5ecd0dc0019119c52124cb/300w", "websiteUrl": "http://www.sustainabledigital.com", "bio": "<p>Website development, training, and consulting services for nonprofit organizations and creative entrepreneurs.<\/p>", "avatarAssetUrl": "https://static1.squarespace.com/static/images/5e5ecd0dc0019119c52124cb/300w" }, "assetUrl": "https://images.squarespace-cdn.com/content/v1/5f2da1110b971b4c6306ef1d/1600768109028-OPRD5DISSJJODGIY2BJK/ke17ZwdGBToddI8pDm48kIwJJ6tADXGT7Z8k3W_ulAYUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYwL8IeDg6_3B-BRuF4nNrNcQkVuAT7tdErd0wQFEGFSnPK39s_dI1ZD20m2mUcKPJgsMapFrUHvZHyFQkXGxFDyaLbszYAFSZ1Y20Sl59g-2A/Next+Play+venture+capital+%E2%80%93+Next+Play+Ventures+%E2%80%93+Venture+Capital+coaching.png", "contentType": "image/png", "items": [ ], "pushedServices": { }, "pendingPushedServices": { }, "recordTypeLabel": "image", "originalSize": "2500x372" }, "imageOverlayOpacity": 0.0, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--small", "customSectionHeight": 10, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 50, "sectionTheme": "", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" >
      <div class="section-background">
        <img alt="" data-src="https://images.squarespace-cdn.com/content/v1/5f2da1110b971b4c6306ef1d/1600768109028-OPRD5DISSJJODGIY2BJK/ke17ZwdGBToddI8pDm48kIwJJ6tADXGT7Z8k3W_ulAYUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYwL8IeDg6_3B-BRuF4nNrNcQkVuAT7tdErd0wQFEGFSnPK39s_dI1ZD20m2mUcKPJgsMapFrUHvZHyFQkXGxFDyaLbszYAFSZ1Y20Sl59g-2A/Next+Play+venture+capital+%E2%80%93+Next+Play+Ventures+%E2%80%93+Venture+Capital+coaching.png" data-image="https://images.squarespace-cdn.com/content/v1/5f2da1110b971b4c6306ef1d/1600768109028-OPRD5DISSJJODGIY2BJK/ke17ZwdGBToddI8pDm48kIwJJ6tADXGT7Z8k3W_ulAYUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYwL8IeDg6_3B-BRuF4nNrNcQkVuAT7tdErd0wQFEGFSnPK39s_dI1ZD20m2mUcKPJgsMapFrUHvZHyFQkXGxFDyaLbszYAFSZ1Y20Sl59g-2A/Next+Play+venture+capital+%E2%80%93+Next+Play+Ventures+%E2%80%93+Venture+Capital+coaching.png" data-image-dimensions="2500x372" data-image-focal-point="0.5,0.5" alt="Next Play venture capital – Next Play Ventures – Venture Capital coaching.png"  data-load="false" />
        <div data-controller="SectionBackgroundOverlayController" data-image-overlay-opacity="0" class="section-background-overlay"></div>
      </div>
      <div class="content-wrapper">
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f5a7b11f042ea3152f397c5">
            <div class="row sqs-row">
              <div class="col sqs-col-12 span-12">
                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-fe8e63140a2cdf96ca3a">
                  <div class="sqs-block-content">
                    <p class="" style="white-space:pre-wrap;">&nbsp;</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section data-test="page-section" data-section-theme="bright-inverse" class='page-section layout-engine-section background-width--full-bleed content-width--wide horizontal-alignment--center vertical-alignment--middle bright-inverse' data-section-id="5f5a7abe50b8f65440a988bd" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 50, "sectionTheme": "bright-inverse", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background"></div>
      <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); ' >
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f5a7abe50b8f65440a988bd">
            <div class="row sqs-row">
              <div class="col sqs-col-12 span-12">
                <div class="row sqs-row">
                  <div class="col sqs-col-11 span-11">
                    <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-4640072b79c0561030d8">
                      <div class="sqs-block-content">
                        <h1 style="white-space:pre-wrap;">Culture</h1>
                      </div>
                    </div>
                  </div>
                  <div class="col sqs-col-1 span-1">
                    <div class="sqs-block code-block sqs-block-code" data-block-type="23" id="block-yui_3_17_2_1_1600139319570_41135">
                      <div class="sqs-block-content">
                        <div id="culture"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="sqs-block summary-v2-block sqs-block-summary-v2" data-block-json="&#123;&quot;collectionId&quot;:&quot;5f343a52779f0079da860716&quot;,&quot;design&quot;:&quot;autogrid&quot;,&quot;headerText&quot;:&quot;Featured&quot;,&quot;textSize&quot;:&quot;medium&quot;,&quot;pageSize&quot;:30,&quot;imageAspectRatio&quot;:&quot;1.5&quot;,&quot;columnWidth&quot;:402,&quot;gutter&quot;:60,&quot;listImageSize&quot;:30,&quot;listImageAlignment&quot;:&quot;left&quot;,&quot;slidesPerRow&quot;:3,&quot;textAlignment&quot;:&quot;left&quot;,&quot;showTitle&quot;:true,&quot;showThumbnail&quot;:false,&quot;showExcerpt&quot;:false,&quot;showReadMoreLink&quot;:false,&quot;showPrice&quot;:true,&quot;productQuickViewEnabled&quot;:false,&quot;showPastOrUpcomingEvents&quot;:&quot;upcoming&quot;,&quot;metadataPosition&quot;:&quot;above-title&quot;,&quot;primaryMetadata&quot;:&quot;tags&quot;,&quot;secondaryMetadata&quot;:&quot;none&quot;,&quot;filter&quot;:&#123;&quot;categoryIds&quot;:null,&quot;category&quot;:&quot;Culture&quot;&#125;,&quot;autoCrop&quot;:true,&quot;lightbox&quot;:false,&quot;mixedContent&quot;:true,&quot;blockId&quot;:&quot;927d36090407e8b15785&quot;&#125;" data-block-type="55" id="block-cf3cce36050cee1e46a5">
                  <div class="sqs-block-content">
                    <div class=" summary-block-wrapper summary-block-collection-type-blog-single-column summary-block-setting-text-size-medium summary-block-setting-text-align-left summary-block-setting-design-autogrid summary-block-setting-design-list-thumbnail-left summary-block-setting-metadata-position-above-title summary-block-setting-primary-metadata-tags summary-block-setting-secondary-metadata-none summary-block-setting-show-title summary-block-setting-show-price summary-block-setting-hide-excerpt sqs-gallery-design-autogrid " >
                      <div class="summary-item-list-container sqs-gallery-container">
                        <header class="summary-block-header">
                          <!-- Collection Title -->
                          <div class="summary-heading" data-animation-role="content">
                            <span class="summary-header-text">Featured</span>
                          </div>
                          <!-- Carousel Nav -->
                          <div class="summary-carousel-pager sqs-gallery-controls" data-animation-role="content">
                            <span class="summary-carousel-pager-prev previous" tabindex="0" role="button" aria-label="Previous" ></span>
                            <span class="summary-carousel-pager-next next" tabindex="0" role="button" aria-label="Next" ></span>
                          </div>
                        </header>
                        <div class="summary-item-list sqs-gallery">
                            <?php if ($result_content_culture): ?>
                            <?php while ($conCulList = mysqli_fetch_array($result_content_culture)): ?>
                            <div class=" summary-item summary-item-record-type-text sqs-gallery-design-autogrid-slide summary-item-has-thumbnail summary-item-has-excerpt summary-item-has-cats summary-item-has-tags summary-item-has-author " >
                              <div class="summary-content sqs-gallery-meta-container" data-animation-role="content">
                                <!-- Metadata (Above Title) -->
                                <div class="summary-metadata-container summary-metadata-container--above-title">
                                  <div class="summary-metadata summary-metadata--primary">
                                    <!-- Tags -->
                                    <span class="summary-metadata-item summary-metadata-item--tags"><a href="<?php echo $conCulList['link'] ?>"><?php echo $conCulList['type'] ?></a></span>
                                  </div>
                                  <div class="summary-metadata summary-metadata--secondary"></div>
                                </div>
                                <!-- Title -->
                                <div class="summary-title">
                                  <a href="<?php echo $conCulList['link'] ?>" class="summary-title-link"><?php echo $conCulList['title'] ?></a>
                                </div>
                              </div>
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </article>
</main>
<?php include 'template/footer.php'; ?>