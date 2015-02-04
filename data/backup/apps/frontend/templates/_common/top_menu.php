<?php if ($sf_user->getGuardUser()->getProfile()->getIsActive()): ?>
                        
       
      <ul class="menu_left">
                  


          <li ><a  href="<?= url_for('@page?alias=mainpage') ?> "><?= __('Main') ?></a>
            <?php if ($sf_user->isAuthenticated()): ?>
              <ul class="menu_left">
                  <li><a href="<?= url_for('profile/member') ?>"><?= __('Member area') ?></a></li>
                  <li><a href="<?= url_for('message/index') ?>"><?= __('My Messages') ?></a></li>
                  <li><a href="<?= url_for('friend/index') ?>"><?= __('Favorite list') ?></a></li>
                  <li><a href="<?= url_for('interest/index') ?>"><?= __('My Interest List') ?></a></li>
                  <li><a href="<?= url_for('viewed/index') ?>"><?= __('Who viewed me') ?></a></li>
                  <li><a href="<?= url_for('matches/index') ?>"><?= __('My Matches') ?></a></li>
                  <li><a href="<?= url_for('chat/index') ?>"><?= __('Chat') ?></a></li>
              </ul>
            <?php endif; ?>
          </li>
          <?php if ($sf_user->isAuthenticated() and $sf_user->getGuardUser()->getGender()=='m'): ?>
              <li ><a href="<?= url_for('mainpage/index') ?> "><?= __('Buy Credits') ?></a>

                      <ul class="menu_left">
                          <li><a href="<?= url_for('account/index') ?>"><?= __('Upgrade membership') ?></a></li>
                          <li><a href="<?= url_for('account/history') ?>"><?= __('Account Options') ?></a></li>
                      </ul>

              </li>
          <?php endif; ?>

          <li ><a  href="<?= url_for('search/index?is_online=true') ?> "><?= __('Online Members') ?></a></li>


          <li ><a  href="<?= url_for('search/index') ?> "><?= __('Galleries') ?></a>

              <ul class="menu_left">
                  <li><a href="<?= url_for('search/index') ?>"><?= __('Album') ?></a></li>
                  <li><a href="<?= url_for('search/index?new=true') ?>"><?= __('New Members') ?></a></li>
                  <li><a href="<?= url_for('search/index?type=top') ?>"><?= __('Top 100') ?></a></li>
                  <li><a href="<?= url_for('search/index?order=rating') ?>"><?= __('Most Viewed') ?></a></li>
                  <li><a href="<?= url_for('search/index?order=unrating') ?>"><?= __('Less Viewed') ?></a></li>
                  <li><a href="<?= url_for('search/anniversary') ?>"><?= __('Anniversaries') ?></a></li>
              </ul>

          </li>
          <li ><a  href="#"><?= __('Videos') ?></a>

              <?php if($sf_request->getParameter('action')=='index' and $sf_request->getParameter('module')=='faq')
              {
                  $cur = 'class="cur"';
              }
              else
              {
                  $cur = '';
              }
              ?>
          <li ><a  href="<?= url_for('search/adv') ?> "><?= __('Advanced search') ?></a></li>
          <li ><a <?php echo $cur ?> href="<?= url_for('faq/index') ?> "><?= __('FAQ') ?></a></li>


          <?php if($sf_request->getParameter('action')=='index' and $sf_request->getParameter('module')=='testimonials')
      {
          $cur = 'class="cur"';
      }
      else
      {
          $cur = '';
      }
          ?>

          <li ><a <?php echo $cur ?> href="<?= url_for('testimonials/index') ?> "><?= __('Testimonials') ?></a></li>



          <li ><a  href="<?= url_for('@page?alias=services') ?> "><?= __('Service') ?></a>

              <ul class="menu_left">
                  <li><a href="<?= url_for('@page?alias=about') ?>"><?= __('About us') ?></a></li>
                  <li><a href="<?= url_for('@page?alias=ourwork') ?>"><?= __('Our work') ?></a></li>
                  <li><a href="<?= url_for('@page?alias=terms') ?>"><?= __('Terms of the site') ?></a></li>
                  <li><a href="<?= url_for('contact/index') ?>"><?= __('Contact Us') ?></a></li>
              </ul>

          </li>
          <?php if ($sf_user->isAuthenticated() and $sf_user->getGuardUser()->getGender()=='m'): ?>
             <li><a href="<?= url_for('price/index') ?>"><?= __('Our prices') ?></a></li>
          <?php endif; ?>

          <li><a href="<?= url_for('@page?alias=scamer') ?>"><?= __('About Scammers') ?></a>

              <ul class="menu_left">
                  <li><a href="<?= url_for('@page?alias=about') ?>"><?= __('We protect you') ?></a></li>
                  <li><a href="<?= url_for('scamer/index') ?>"><?= __('Black list') ?></a></li>
              </ul>

          </li>

          <li><a href="<?= url_for('@page?alias=info') ?>"><?= __('Information') ?></a>

              <ul class="menu_left">
                  <?php if ($sf_user->isAuthenticated() and $sf_user->getGuardUser()->getGender()=='m'): ?>
                    <li><a href="<?= url_for('@page?alias=russian_women') ?>"><?= __('Russian Women') ?></a></li>
                  <?php else: ?>
                    <li><a href="<?= url_for('@page?alias=west_men') ?>"><?= __('West Men') ?></a></li>
                  <?php endif; ?>
                  <li><a href="<?= url_for('@page?alias=black_list') ?>"><?= __('Black list') ?></a></li>
              </ul>

          </li>

          <li><a href="<?= url_for('@page?alias=visit_ukraine') ?>"><?= __('Visit Ukrane') ?></a></li>

          <li><a href="<?= url_for('@page?alias=visit_russia') ?>"><?= __('Visit Russia') ?></a></li>



          <?php if ($sf_user->isAuthenticated()): ?>
              <li><?php echo link_to(__('Exit'),'@sf_guard_signout')?></li>
          <?php endif; ?>

      </ul>

<?php endif; ?>
