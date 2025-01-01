#include <iostream>
using namespace std;

// Abstraction
class RemoteControl {
public:
  virtual void turn_on() = 0;
  virtual void turn_off() = 0;
};

// Implementations
class Device {
public:
  virtual void turn_on() = 0;
  virtual void turn_off() = 0;
};

class Television : public Device {
public:
  void turn_on() override {
    std::cout << "Television is now ON" << std::endl;
  }

  void turn_off() override {
    std::cout << "Television is now OFF" << std::endl;
  }
};

class Radio : public Device {
public:
  void turn_on() override {
    std::cout << "Radio is now ON" << std::endl;
  }

  void turn_off() override {
    std::cout << "Radio is now OFF" << std::endl;
  }
};

// Client code using Bridge Pattern
class RemoteControlWithDevice : public RemoteControl {
private:
  Device* device;

public:
  RemoteControlWithDevice(Device* dev) : device(dev) {}

  void turn_on() override {
    device->turn_on();
  }

  void turn_off() override {
    device->turn_off();
  }
};

int main() {
  Television tv;
  RemoteControlWithDevice remote_tv(&tv);
  remote_tv.turn_on();   // Output: Television is now ON
  remote_tv.turn_off();  // Output: Television is now OFF

  Radio radio;
  RemoteControlWithDevice remote_radio(&radio);
  remote_radio.turn_on();   // Output: Radio is now ON
  remote_radio.turn_off();  // Output: Radio is now OFF

  return 0;
}