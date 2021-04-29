package com.example.harms_1;

public class Result {
    int result_id;

    public Result(int result_id, String room_Name, String appliance_Name, String time, int state) {
        this.result_id = result_id;
        Room_Name = room_Name;
        Appliance_Name = appliance_Name;
        this.time = time;
        this.state = state;
    }

    String Room_Name, Appliance_Name, time;
    int state;

    public int getResult_id() {
        return result_id;
    }

    public void setResult_id(int result_id) {
        this.result_id = result_id;
    }

    public String getRoom_Name() {
        return Room_Name;
    }

    public void setRoom_Name(String room_Name) {
        Room_Name = room_Name;
    }

    public String getAppliance_Name() {
        return Appliance_Name;
    }

    public void setAppliance_Name(String appliance_Name) {
        Appliance_Name = appliance_Name;
    }

    public String getTime() {
        return time;
    }

    public void setTime(String time) {
        this.time = time;
    }

    public int getState() {
        return state;
    }

    public void setState(int state) {
        this.state = state;
    }
}
