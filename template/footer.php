<footer class="page-footer">
  <div class="container">
    <a class="page-footer__logo" href="#">
      <img src="/img/logo--footer.svg" alt="Fashion">
    </a>
    <nav class="page-footer__menu">
        <?=showMenu('sort', 'main-menu main-menu--footer', 'main-menu__item', array())?>
    </nav>
    <address class="page-footer__copyright">
      © Все права защищены
    </address>
  </div>
</footer>

<?php if (isset($priceBegin) || isset($priceEnd) || isset($oldPriceBegin) || isset($oldPriceEnd)): ?>

  <script>
    minPrice = <?=isset($priceBegin) ? $priceBegin : ""?>;
    maxPrice = <?=isset($priceEnd) ? $priceEnd : ""?>;
    oldMinPrice = <?=isset($oldPriceBegin) ? $oldPriceBegin : ""?>;
    oldMaxPrice = <?=isset($oldPriceEnd) ? $oldPriceEnd : ""?>;
  </script>
  
<?php endif; ?>  
  
  <script src="/js/scripts.js" defer=""></script>
</body>
</html>