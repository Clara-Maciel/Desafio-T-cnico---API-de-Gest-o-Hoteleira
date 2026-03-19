<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Reservation;


class ImportXml extends Command
{
    /**
     * Execute the console command.
     */

    protected $signature = 'import:xml';
    protected $description = 'Importa dados de arquivos XML para o banco de dados';
    
    public function handle()
    {
      $this->importHotels();
        $this->importRooms();
        $this->importReservations();
        $this->info('Importação concluída com sucesso!');
    }

    private function importHotels()
    {
        $xml = simplexml_load_file(database_path('xml/hotels.xml'));

        foreach ($xml->hotel as $hotel) {
            Hotel::updateOrCreate(
                ['id' => (int) $hotel['id']],
                ['name' => (string) $hotel->name]
            );
        }

        $this->info('Hotels importados!');
    }

    private function importRooms()
    {
        $xml = simplexml_load_file(database_path('xml/rooms.xml'));

        foreach ($xml->room as $room) {
            Room::updateOrCreate(
                ['id' => (int) $room['id']],
                [
                    'hotel_id'        => (int) $room['hotel_id'],
                    'name'            => (string) $room,
                    'inventory_count' => (int) $room['inventory_count'],
                ]
            );
        }

        $this->info('Rooms importados!');
    }

    private function importReservations()
    {
        $xml = simplexml_load_file(database_path('xml/reservations.xml'));

        foreach ($xml->reservation as $res) {
            Reservation::updateOrCreate(
                ['id' => (int) $res->id],
                [
                    'hotel_id'         => (int) $res->hotel_id,
                    'room_id'          => (int) $res->room->id,
                    'guest_first_name' => (string) $res->customer->first_name,
                    'guest_last_name'  => (string) $res->customer->last_name,
                    'arrival_date'     => (string) $res->room->arrival_date,
                    'departure_date'   => (string) $res->room->departure_date,
                    'meal_plan'        => (string) $res->room->meal_plan,
                    'guest_count'      => (int) $res->room->guest_counts->guest_count['count'],
                    'total_price'      => (float) $res->room->totalprice,
                    'currency_code'    => (string) $res->room->currencycode,
                ]
            );
        }

        $this->info('Reservations importadas!');
    }
}
