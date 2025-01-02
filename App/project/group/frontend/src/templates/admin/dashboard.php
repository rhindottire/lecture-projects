<?php function dashboard(
  $client = [],
  $subscriber = [],
  $payments = []
) {
  $items = [
    'client' => $client,
    'subscriber' => $subscriber,
    'payments' => $payments
  ];
  $totalPayments = isset($payments['data'])
    ? array_sum(array_column($payments['data'], 'nominal'))
    : 0;
?>
  <div id="pages" class="w-full p-5 grid grid-cols-3 gap-8">
    <?php foreach ($items as $item) : ?>
      <div class="flex flex-1 p-5 bg-black mt-4 text-white rounded-lg">
        <div class="p-3">
          <?php if (isset($item['icon']) && is_callable($item['icon'])) : ?>
            <h1><?= $item['icon']() ?></h1>
          <?php endif; ?>
        </div>
        <div class="flex flex-col justify-center gap-3">
          <h1><?= $item['text'] ?? '' ?></h1>
          <?php if (isset($item['text']) && $item['text'] === "Incoming Payments") : ?>
            <h1>IDR <?= number_format($totalPayments, 0, ',', '.') ?></h1>
          <?php else : ?>
            <h1><?= count($item['data'] ?? []) ?> Total</h1>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

<?php } ?>