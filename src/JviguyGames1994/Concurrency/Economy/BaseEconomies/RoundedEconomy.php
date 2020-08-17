<?php
declare(strict_types=1);

namespace JviguyGames1994\Concurrency\Economy\BaseEconomies;

use http\Exception\InvalidArgumentException;
use JviguyGames1994\Concurrency\Economy\EconomyUtils\BaseEconomies\Balance;
use pocketmine\Server;

class RoundedEconomy extends BaseEconomy
{

	//properties
	/** @var array $balances the balances of all registered players */
	private $balances;
	/**
	 * @var int $startingamount
	 */
	private $startingamount;
	/**
	 * @var int $moneycap
	 */
	private $moneycap;
	//constructor
	public function __construct(int $startingamount=0, int $moneycap=PHP_INT_MAX){
		$this->startingamount = $startingamount;
		$this->moneycap = $moneycap;
	}
	//Functions
	public function getType()
	{
		return self::class;
	}

	protected function getBalances(): array
	{
		return $this->balances;
	}
	protected function removeBalance(string $uuid){
		unset($this->balances[$uuid]);
	}
	protected function addBalance(string $uuid){
		$this->balances[$uuid] = new Balance($this->startingamount);
	}

	public function register()
	{
		foreach (Server::getInstance()->getOnlinePlayers() as $player) {
			$this->addBalance($player->getName());
		}
	}

	protected function getBalance(string $uuid): Balance
	{
		if (isset($this->getBalances()[$uuid])){
			return $this->getBalances()[$uuid];
		} else {
			throw new InvalidArgumentException("UUID {$uuid} Is not registered!");
		}
	}

	public function add(string $uuid, int $amount)
	{
		// TODO: Implement add() method.
	}

	public function subtract(string $uuid, int $amount)
	{
		// TODO: Implement subtract() method.
	}

	public function get(string $uuid)
	{

	}

	public function set(string $uuid, int $amount)
	{

	}

	public function sum(string $uuid, int $amount)
	{

	}

	public function isRegistered(string $uuid): bool{try {$this->getBalances()[$uuid];} catch (\ErrorException $exception){return false;}return true;}
}