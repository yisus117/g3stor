
  <div class="hint-text text-secondary <?=  $pager->getPageCount() == 0 ? "d-none" : "" ?>">pagina <b> <?= $pager->getCurrentPageNumber()  ?> </b> de <b> <?= $pager->getPageCount() ?></b></div>


<ul class="pagination" aria-label="<?= lang("Pager.pageNavigation") ?>">

<?php if ($pager->hasPreviousPage()) : ?>
  <li class="page-item">
    <a href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>" style="background-color: <?= config("G3stor")->secondColor ?>;" class="page-link btn text-white">
      <i class="fa-solid fa-arrow-left"></i>
    </a>
  </li>
<?php endif ?>

<?php foreach ($pager->links() as $link) : ?>
  <?php if (count($pager->links()) > 1) : ?>

    <li class="page-item  <?= $link['active'] ? 'active' : '' ?>">
      <a href="<?= $link['uri'] ?>" class="page-link text-white" style="background-color: <?= config("G3stor")->secondColor ?>;">
        <?= $link['title'] ?>
      </a>
    </li>
  <?php endif ?>

<?php endforeach ?>

<?php if ($pager->hasNextPage()) : ?>
  <li class="page-item">
    <a href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>" style="background-color: <?= config("G3stor")->secondColor ?>;" class="page-link text-white">
      <i class="fa-solid fa-arrow-right"></i>
    </a>
  </li>
<?php endif ?>

</ul>


