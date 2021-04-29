package com.example.harms_1;

public class Cards {

    private String action;
    private String room;
    private String appliance;

    public Cards( String action, String room,String appliance) {
        this.action = action;
        this.room = room;
        this.appliance = appliance;
    }

    public String getRoom() {
        return room;
    }

    public String getAppliance() {
        return appliance;
    }

    public String getAction() {
        return action;
    }
}
