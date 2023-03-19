<?php

namespace App\Chapter3;

use App\Chapter4\IChargable;
use App\Chapter3\CdProduct;
use App\Chapter4\PriceUtilities;
use App\Chapter4\IdentityTrait;
use App\Chapter4\UtilityService;




class ShopProduct
{
	use PriceUtilities;
	use IdentityTrait;

	public const AVAILABLE = 0;
	public const OUT_OF_STOCK = 0;

	private int|float $discount = 0;
	private int $id = 0;
	private static int $taxRate = 20;

	public function __construct(
		private string $title,
		private string $producerFirstName,
		private string $producerMainName,
		protected int|float $price
	) {
	}

	public function getTaxRate(): float
    {
		return 1.0;
    }

	public function setID(int $id)
	{
		$this->id = $id;
	}

	public static function getInstance(int $id, \PDO $pdo): null|ShopProduct
	{
		$stmt = $pdo->prepare("SELECT * FROM Products WHERE id = ?");
		$result = $stmt->execute([$id]);

		$row = $stmt->fetch();

		if (empty($row)) {
			return null;
		}

		if ($row["type"] == "book") {
			$product = new BookProduct(
				$row["title"],
				$row["firstname"],
				$row["mainname"],
				(float) $row["price"],
				(int) $row["numpages"],
			);
		} elseif ($row["type"] == "cd") {
			$product = new CdProduct(
				$row["title"],
				$row["firstname"],
				$row["mainname"],
				(float) $row["price"],
				(int) $row["playlength"],
			);
		} else {
			$firstName = (is_null($row["firstname"])) ? "" : $row["firstname"];

			$product = new ShopProduct(
				$row["title"],
				$firstName,
				$row["mainname"],
				(float) $row["price"],
			);
		}

		$product->setId((int) $row["ID"]);
		$product->setDiscount((int) $row["discount"]);

		return $product;
	}

	public function getProducerFirstName(): string
	{
		return $this->producerFirstName;
	}

	public function getProducerMainName(): string
	{
		return $this->producerMainName;
	}

	public function setDiscount(int|float $num): void
	{
		$this->discount = $num;
	}

	public function getDiscount(): int
	{
		return $this->discount;
	}

	public function getTitle(): string
	{
		return $this->title;
	}

	public function getPrice(): int|float
	{
		return ($this->price - $this->discount);
	}

	public function getProducer(): string
	{
		return "{$this->producerFirstName} {$this->producerMainName}";
	}

	public function getSummaryLine(): string
	{
		$base = "{$this->title} ({$this->producerMainName}, ";
		$base .= "{$this->producerFirstName} )";
		return $base;
	}

	public function cdInfo(CdProduct $prod): int
	{
		$length = $prod->playLength;

		return $length;
	}
}

$p = new ShopProduct("Laptop", "Thinkpad", "Lenovo", 100.75);

print $p->calculateTax(100) . "\n";

$u = new UtilityService(5);

print $u->calculateTax(100) . "\n";

print $u->generateId();