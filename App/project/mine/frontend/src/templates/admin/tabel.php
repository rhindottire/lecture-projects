<?php function getNestedValue($array, $keys) {
  foreach ($keys as $key) {
    if (isset($array[$key])) {
      $array = $array[$key];
    } else {
      return null;
    }
  }
  return $array;
}

function tableContainer(
  &$dataToShow,
  $columns,
  &$offset = 0,
  $actions = []
) {
  function renderValue($key, $value) {
    switch ($key) {
      case 'role':
        return $value !== 'ADMIN'
          ? '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-600 text-white">Client</span>'
          : '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-600 text-white">Admin</span>';
      case 'token':
        return $value !== null
          ? '<span class="text-green-500 font-semibold">Online</span>'
          : '<span class="text-red-500 font-semibold">Offline</span>';
      case 'nominal':
        return 'Rp ' . number_format($value, 0, ',', '.');
      case 'premium':
        return $value == 1
          ? '<span class="text-green-500 font-semibold">Active</span>'
          : '<span class="text-red-500 font-semibold">Ended</span>';
      case 'jenis':
        return '<span class="px-2 py-1 rounded-full text-white ' . getJenisClass($value) . '">' . $value . '</span>';
      case 'status':
        return '<span class="px-2 py-1 rounded-full text-white ' . getStatusClass($value) . '">' . $value . '</span>';
      case 'createAt':
      case 'startDate':
      case 'endDate':
        return !empty($value) ? (new DateTime($value))->format('Y-m-d') : '';
      default:
        return $value;
    }
  }

  function getJenisClass($value) {
    switch ($value) {
      case 'MASTER':
        return 'bg-blue-500';
      case 'EXPERT':
        return 'bg-yellow-500';
      case 'BASIC':
        return 'bg-red-500';
      default:
        return '';
    }
  }

  function getStatusClass($value) {
    switch ($value) {
      case 'SUCCESS':
        return 'bg-green-500';
      case 'PENDING':
        return 'bg-blue-500';
      case 'FAILED':
        return 'bg-red-500';
      default:
        return '';
    }
  }
?>
  <table class="w-full text-center mt-4 border-collapse border border-gray-300">
    <thead class="bg-black text-white">
      <tr class="hover:text-cyan-500">
        <th class="p-3 border border-gray-300">No</th>
        <?php foreach ($columns as $label) : ?>
          <th class="p-3 border border-gray-300"><?= $label["header"] ?></th>
        <?php endforeach; ?>
        <?php if (!empty($actions)) : ?>
          <th class="p-3 border border-gray-300">Action</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody class="bg-white">
      <?php foreach ($dataToShow as $index => $item) : ?>
        <tr class="hover:bg-gray-300">
          <td class="p-2 border border-gray-300"><?= $offset + $index + 1 ?></td>
          <?php foreach ($columns as $key => $label) : ?>
            <td class="p-2 border border-gray-300">
              <span class="<?= $label["class"] ?? "" ?>">
                <?php
                  $keys = str_contains($key, ".") ? explode(".", $key) : [$key];
                  $value = getNestedValue($item, $keys);
                  echo renderValue($key, $value);
                ?>
              </span>
            </td>
          <?php endforeach; ?>
          <?php if (!empty($actions)) : ?>
            <td class="p-2 border border-gray-300">
              <?php foreach ($actions as $action) : ?>
                <button
                id="<?= $item['id'] ?>"
                class="<?= $action['class'] ?>"
                onclick="<?= $action['onclick'] ?? '' ?>"
                >
                  <?= $action['label'] ?>
                </button>
              <?php endforeach; ?>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php } ?>