<?php
function Format_rupiah($angka)
{
  $rupiah = number_format($angka, 0, ',', '.');
  return $rupiah;
}
