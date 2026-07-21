<?php if (!defined('EW_SITE')) { http_response_code(404); exit; } ?>
                                <div class="banner-podstrona">

                                        <div class="desc2">
<h1 class="tytul">kontakt</h1>



                                    <p class="tresc-kontakt">
                                      <?= e($contact['name']) ?><br/>
                                      Tel:  <?= e($contact['phone']) ?><br/>
Email:  <a href="mailto:<?= e($contact['email']) ?>"><?= e($contact['email']) ?></a><br/>
<?= e($contact['street']) ?><br/>
<?= e($contact['postcode']) ?> <?= e($contact['city']) ?><br/>

                                      </p>

                                            <p class="tresc-kontakt2"> <span class="duza-niebieska">
                                         Napisz lub zadzwoń i umów się na spotkanie.</span>
                                         </p>

                                      <div id="form_box">
                                        <form id="myForm" action="<?= e($assetBase) ?>ajax_email/send.php" method="post" name="myForm">
                                          <div>
                                            <p><label for="cf-name">Imię i nazwisko:</label></p>
                                            <input class="input" type="text" id="cf-name" name="name" required>
                                          </div>
                                          <div>
                                            <p><label for="cf-email">Adres e-mail:</label></p>
                                            <input class="input" type="email" id="cf-email" name="e_mail" required>
                                          </div>
                                          <div>
                                            <p><label for="cf-phone">Telefon (opcjonalnie):</label></p>
                                            <input class="input" type="tel" id="cf-phone" name="phone">
                                          </div>
                                          <div>
                                            <p><label for="cf-message">Wiadomość:</label></p>
                                            <textarea class="textarea" id="cf-message" name="message" rows="6" required></textarea>
                                          </div>
                                          <div class="hp-field" style="display:none" aria-hidden="true">
                                            <input type="text" id="cf-website" name="website" tabindex="-1" autocomplete="off">
                                          </div>
                                          <div>
                                            <input class="submit" type="submit" value="Wyślij wiadomość">
                                          </div>
                                        </form>
                                        <div id="log"><div id="log_res"></div></div>
                                      </div>


                                      <div class="zapr">


                                                                            <p class="duza-prawa2">Zapraszam!
</p>


                                        </div>


                                      </div>

                                </div>
