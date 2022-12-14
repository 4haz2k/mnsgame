<?php


namespace App\Http\Services;


use App\Http\Interfaces\PaymentTypes;

class PaymentsHandler
{
    private array $selectedPacket;

    public function __construct(string $type)
    {
        switch ($type){
            case PaymentTypes::PACKET_RATING["title"]:
                $this->selectedPacket = PaymentTypes::PACKET_RATING;
                break;
            case PaymentTypes::PACKET_RUBY["title"]:
                $this->selectedPacket = PaymentTypes::PACKET_RUBY;
                break;
            case PaymentTypes::PACKET_SAPPHIRE["title"]:
                $this->selectedPacket = PaymentTypes::PACKET_SAPPHIRE;
                break;
            case PaymentTypes::PACKET_EMERALD["title"]:
                $this->selectedPacket = PaymentTypes::PACKET_EMERALD;
                break;
        }
    }

    public function getPacket(): array {
        return $this->selectedPacket;
    }

    public function getRatingToSet(): int {
        switch ($this->selectedPacket) {
            case PaymentTypes::PACKET_RATING:
                return PaymentTypes::PACKET_RATING["rating"];
            case PaymentTypes::PACKET_RUBY:
                return PaymentTypes::PACKET_RUBY["rating"];
            case PaymentTypes::PACKET_SAPPHIRE:
                return PaymentTypes::PACKET_SAPPHIRE["rating"];
            case PaymentTypes::PACKET_EMERALD:
                return PaymentTypes::PACKET_EMERALD["rating"];
            default:
                return 0;
        }
    }

    public function getTimeToSet(): string {
        switch ($this->selectedPacket) {
            case PaymentTypes::PACKET_SAPPHIRE:
            case PaymentTypes::PACKET_EMERALD:
            case PaymentTypes::PACKET_RATING:
                return "1 month";
            case PaymentTypes::PACKET_RUBY:
                return "1 week";
            default:
                return 0;
        }
    }
}
