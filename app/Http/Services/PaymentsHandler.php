<?php


namespace App\Http\Services;


class PaymentsHandler
{
    private array $packets = [
        "rating" => 1,
        "packet1" => 99,
        "packet2" => 189,
        "packet3" => 249,
    ];

    private array $selectedPaket;

    public function __construct(string $type)
    {
        switch ($type){
            case "rating":
                $this->selectedPaket = [
                    "packet" => "rating",
                    "price" => $this->packets["rating"]
                ];
                break;
            case "packet1":
                $this->selectedPaket = [
                    "packet" => "packet1",
                    "price" => $this->packets["packet1"]
                ];
                break;
            case "packet2":
                $this->selectedPaket = [
                    "packet" => "packet2",
                    "price" => $this->packets["packet2"]
                ];
                break;
            case "packet3":
                $this->selectedPaket = [
                    "packet" => "packet3",
                    "price" => $this->packets["packet3"]
                ];
                break;
        }
    }

    public function getPacket(): array {
        return $this->selectedPaket;
    }

    public function getRatingToSet(): int {
        switch ($this->selectedPaket["packet"]) {
            case "rating":
                return 1;
            case "packet1":
                return 150;
            case "packet2":
                return 200;
            case "packet3":
                return 300;
            default:
                return 0;
        }
    }

    public function getTimeToSet(): string {
        switch ($this->selectedPaket["packet"]) {
            case "packet2":
            case "packet3":
            case "rating":
                return "1 month";
            case "packet1":
                return "1 week";
            default:
                return 0;
        }
    }
}
