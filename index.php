<?php 

interface Vehicle {
    public function inspect();
}

class Car implements Vehicle {
    public function inspect() {}
}

class Bike implements Vehicle {
    public function inspect() {}
}

interface Factory {
    public function makeVehicle(): Vehicle;
}

class CarFactory implements Factory {
    public function makeVehicle(): Vehicle {
    return new Car();
    }
}

class BikeFactory implements Factory {
    public function makeVehicle(): Vehicle {
    return new Bike();
    }
}

class InspectionService {
    private static $instance;
    private $countInspectVehicle;

    private function __construct() {
        $this->countInspectVehicle = 0;
    }

    static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new InspectionService();
        }

        return self::$instance;
    }

    public function numberOfVehicle(Vehicle $vehicle) {
        $this->countInspectVehicle++;
        printf("\nBroj pregledanih vozila je %s", $this->countInspectVehicle);

    }

}

$factory = new CarFactory();
$car = $factory->makeVehicle();

InspectionService::getInstance()->numberOfVehicle($car);



