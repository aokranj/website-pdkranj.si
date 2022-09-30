  <!-- skeleton loader  -->
  <div id="wpdm-social-share-loader" class="absolute left-0 top-0 w-full h-full z-50 bg-white text-slate-600 p-4">
      <div class="flex flex-col gap-2 ">
          <?php for ($i = 0; $i < 10; $i++) : ?>
              <div class="flex items-center gap-2">
                  <?php for ($j = 0; $j < rand(2, 4); $j++) : ?>
                      <div class="h-8 w-full bg-slate-200 rounded-md"></div>
                  <?php endfor; ?>
              </div>
          <?php endfor; ?>
      </div>
  </div>