
<h1> <?= __('Buy credit') ?> </h1>

<table class="table1" width="100%">


        <?php foreach($tbil as $t): ?>
      <tr>
          <th>
              <?= $t->getTitle() ?>
          </th>
          <td>
              <form method="POST" action="<?= url_for('account/add') ?>">
               <input type="hidden" value="<?= $t->getId() ?>" name="type">
               <select name="term" style="width: 200px">
                   <option value="1"><?= __('1 month (%1% &euro;)', array('%1%'=>$t->getSumma())) ?></option>
                   <option value="2"><?= __('2 month (%1% &euro;)', array('%1%'=>$t->getSumma()*2)) ?></option>
                   <option value="3"><?= __('3 month (%1% &euro;)', array('%1%'=>$t->getSumma()*3)) ?></option>
               </select>

               <input type="submit" value="<?= __('Bye now') ?>">
              </form>
            </div>
          </td>
      </tr>
    <?php endforeach; ?>


    <tr>
        <th>
            <?= __('Replenish your account')  ?>
        </th>
        <td>
            <form method="POST" action="<?= url_for('account/add') ?>">
                <input type="hidden" value="00" name="type">
                <select name="term" style="width: 200px">
                    <option value="10">10 &euro; </option>
                    <option value="15">15 &euro;</option>
                    <option value="20">20 &euro;</option>
                </select>

                <input type="submit" value="<?= __('Bye now') ?>">
            </form>
            </div>
        </td>
    </tr>

  

</table>

<div style="font-size: 16px"> <?= __('On your account') ?> : <?= $sf_user->getGuardUser()->getProfile()->getAccount() ?> &euro;</div>



