<?php 
$page_title = "Contact";
include 'template/header.php';
    
$first_name = '';
$last_name = '';
$email = '';
$linkedin_link = '';
$message = '';
    
// Save product information
if (isset($_POST['contactSubmit'])) {
    extract($_POST);

    $first_name = validateInput($first_name);
    $last_name = validateInput($last_name);
    $email = validateInput($email);
    $linkedin_link = validateInput($linkedin_link);
    $message = validateInput($message);
    
    $date = date('d/m/Y');

    if (empty($first_name) || $first_name === '') {
        $error = "First Name required";
    } else if (empty($last_name) || $last_name === '') {
        $error = "Last Name required";
    } else if (empty($email) || $email === '') {
        $error = "Email ID required";
    } else if (empty($message) || $message === '') {
        $error = "Message required";
    } else {
        if ($flag == 0) {
            $customArray = '';
            $customArray .= 'first_name = "' . $first_name . '"';
            $customArray .= ',last_name = "' . $last_name . '"';
            $customArray .= ',email = "' . $email . '"';
            $customArray .= ',linkedin_link = "' . $linkedin_link . '"';
            $customArray .= ',message = "' . $message . '"';

            // Sending Email //
            $to = 'aminrahat420@gmail.com';
            $subject = "HYDE Ventures Notification";
            $mail_body = "<html>
            <body>
            Mail From : {$first_name} {$last_name} <br>
            Email : {$email}
            LinkedIn Link : {$linkedin_link}
            Massage : {$message} <br>
            <br>
            <br>This is an automatically generated email. Please do not reply to this message.<br />
            Date: {$date}</p>
            </body>
            </html>";
            $from = 'HYDE Ventures <info@muktoprojukti.com>';
            $headers =
            "Content-type: text/html\r\n" . // Context type
            "X-Priority: 1\n". //headers for priority
            "Priority: Urgent\n". //headers for priority
            "Importance: high";
            $sendMail = mail($to, $subject, $mail_body, $headers, "-f$from");

            if ($sendMail) {
                // save / insert value in table and show a message
                $sqlInsertMessage = "INSERT INTO notification SET $customArray";
                $resultInsertMessage = mysqli_query($con, $sqlInsertMessage);
                if ($resultInsertMessage) {
                    $success = "Thank You to Contact with Us, We Will Get Back to You Soon !";
                } else {
                    $error = "Mail Could Not be Seved " . mysqli_error($con);
                }
            } else {
                $error = "Mail Could Not be Sent " . mysqli_error($con);
            }
        }
    }
}

?>
<main id="page" class="container" role="main">
  <article class="sections" data-page-sections="5f3959a78ac3806791b20e5b" id="sections">
<section data-test="page-section" data-section-theme="white-bold" class='page-section layout-engine-section background-width--full-bleed content-width--wide horizontal-alignment--center vertical-alignment--middle white-bold' data-section-id="5f4524485dc37a6ac78903c4" data-controller="SectionWrapperController, MagicPaddingController" data-current-styles="{ "imageOverlayOpacity": 0.15, "backgroundWidth": "background-width--full-bleed", "sectionHeight": "section-height--custom", "customSectionHeight": 30, "horizontalAlignment": "horizontal-alignment--center", "verticalAlignment": "vertical-alignment--middle", "contentWidth": "content-width--wide", "customContentWidth": 50, "sectionTheme": "white-bold", "sectionAnimation": "none", "backgroundMode": "image" }" data-animation="none" style="min-height: 30vh;" >
      <div class="section-background"></div>
      <div class="content-wrapper" style=' padding-top: calc(30vmax / 10); padding-bottom: calc(30vmax / 10); ' >
        <div class="content">
          <div class="sqs-layout sqs-grid-12 columns-12" data-type="page-section" id="page-section-5f4524485dc37a6ac78903c4">
            <div class="row sqs-row">
              <div class="col sqs-col-5 span-5">
                <div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-yui_3_17_2_1_1600142439014_5171">
                  <div class="sqs-block-content">
                      <h3 style="white-space:pre-wrap;">Contact <?php echo $site_name; ?></h3>
                    <p class="" style="white-space:pre-wrap;">If you are interested in partnering with Next Play Ventures, please find us on <a href="<?php echo $site_linkedin_link; ?>" target="_blank"><strong>LinkedIn</strong></a><strong> </strong>or complete the form. </p>
                    <p class="" style="white-space:pre-wrap;">You can learn more about our investments on <a href="#" target="_blank"><strong>Crunchbase</strong></a><strong> </strong>or <a href="#" target="_blank"><strong>Pitchbook</strong></a><strong>.</strong></p>
                    <p class="" style="white-space:pre-wrap;">Please reference our <a href="#" target="_blank"><strong>media kit</strong></a> for headshots and logos. </p>
                    <p class="" style="white-space:pre-wrap;"><a href="mailto:<?php echo $site_email; ?>"><strong><?php echo $site_email; ?></strong></a><strong><br></strong><?php echo $site_location; ?></p>
                  </div>
                </div>
                <div class="sqs-block socialaccountlinks-v2-block sqs-block-socialaccountlinks-v2" data-block-type="54" id="block-38debf9961c5a53d170f">
                  <div class="sqs-block-content">
                    <div class="sqs-svg-icon--outer social-icon-alignment-left social-icons-color- social-icons-size-small social-icons-style-regular " >
                      <nav class="sqs-svg-icon--list">
                        <a href="<?php echo $site_linkedin_link; ?>" target="_blank" class="sqs-svg-icon--wrapper linkedin-unauth" aria-label="LinkedIn">
                          <div>
                            <svg class="sqs-svg-icon--social" viewBox="0 0 64 64">
                              <use class="sqs-use--icon" xlink:href="#linkedin-unauth-icon"></use>
                              <use class="sqs-use--mask" xlink:href="#linkedin-unauth-mask"></use>
                            </svg>
                          </div>
                        </a>
                        <a href="<?php echo $site_twitter_link; ?>" target="_blank" class="sqs-svg-icon--wrapper twitter-unauth" aria-label="Twitter">
                          <div>
                            <svg class="sqs-svg-icon--social" viewBox="0 0 64 64">
                              <use class="sqs-use--icon" xlink:href="#twitter-unauth-icon"></use>
                              <use class="sqs-use--mask" xlink:href="#twitter-unauth-mask"></use>
                            </svg>
                          </div>
                        </a>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col sqs-col-1 span-1">
                <div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-46f6c67eb919556b8f02">
                  <div class="sqs-block-content">&nbsp;</div>
                </div>
              </div>
              <div class="col sqs-col-6 span-6">
                <div class="sqs-block form-block sqs-block-form" data-block-type="9" id="block-a2295e6e2d717f2297ea">
                  <div class="sqs-block-content">
                    <div class="form-wrapper">
                      <div class="form-inner-wrapper">
                        <form method="POST" action="">
                          <div class="field-list clear">
                            <fieldset id="name-yui_3_17_2_1_1553888888520_3744" class="form-item fields name required">
                              <legend class="title">
                                Name
                                <span class="required" aria-hidden="true">*</span>
                              </legend>
                              <div class="field first-name">
                                <label class="caption">
                                <input class="field-element field-control" name="first_name" type="text" required/>
                                <span class="caption-text">First Name</span>
                                </label>
                              </div>
                              <div class="field last-name">
                                <label class="caption">
                                <input class="field-element field-control" name="last_name" type="text" required/>
                                <span class="caption-text">Last Name</span>
                                </label>
                              </div>
                            </fieldset>
                            <div id="email-yui_3_17_2_1_1553888888520_3745" class="form-item field email required">
                              <label class="title" for="email-yui_3_17_2_1_1553888888520_3745-field">
                              Email
                              <span class="required" aria-hidden="true">*</span>
                              </label>
                              <input class="field-element" name="email" type="email" required/>
                            </div>
                            <div id="text-yui_3_17_2_1_1600141733463_9333" class="form-item field text">
                              <label class="title" for="text-yui_3_17_2_1_1600141733463_9333-field">
                              LinkedIn Profile
                              </label>
                                <input class="field-element text" type="text" name="linkedin_link" placeholder="http://" />
                            </div>
                            <div id="textarea-yui_3_17_2_1_1553888888520_3747" class="form-item field textarea required">
                              <label class="title" for="textarea-yui_3_17_2_1_1553888888520_3747-field">
                              Message
                              <span class="required" aria-hidden="true">*</span>
                              </label>
                                <textarea class="field-element " name="message" required/></textarea>
                            </div>
                          </div>
                          <div data-animation-role="button" class=" form-button-wrapper form-button-wrapper--align-left " >
                              <input class="button sqs-system-button sqs-editable-button" type="submit" name="contactSubmit" value="Send Massage"/>
                          </div>
                        </form>
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
  </article>
</main>
<?php include 'template/footer.php'; ?>
