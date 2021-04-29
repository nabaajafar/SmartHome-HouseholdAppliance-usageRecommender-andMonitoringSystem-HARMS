package com.example.harms_1;

import android.content.Context;
import android.widget.Toast;

public  class TMessage {
    public static void message(Context context, String msgttext){
        Toast.makeText(context,msgttext, Toast.LENGTH_LONG).show();
    }
}
