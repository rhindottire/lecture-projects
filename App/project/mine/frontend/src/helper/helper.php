<?php function paginateData($data) {
  $limit = 5;
  $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
  $totalData = count($data);
  $totalPages = ceil($totalData / $limit);
  $offset = ($currentPage - 1) * $limit;
  $dataToShow = array_slice($data, $offset, $limit);
  return [
    'limit' => $limit,
    'offset' => $offset,
    'totalPages' => $totalPages,
    'dataToShow' => $dataToShow,
    'currentPage' => $currentPage,
  ];
}
