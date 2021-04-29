package com.example.harms_1;

import android.os.Bundle;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class Pattren extends AppCompatActivity {

    //this is the JSON Data URL
    private static final String URL_PRODUCTS = "http://192.168.1.30/LoginRegister/actions.php";

    //a list to store all the cards
    List<Cards> cardsList;

    //the recyclerview
    RecyclerView recyclerView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_recycle);

        //getting the recyclerview from xml
        recyclerView = findViewById(R.id.recyclerView);
        recyclerView.setHasFixedSize(true);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));

        // initializing the cardslist
        cardsList = new ArrayList<>();

        //this method will fetch and parse json
        //to display it in recyclerview
        loadCards();
    }

    private void loadCards() {

        /*
         * Creating a String Request
         * The request type is GET defined by first parameter
         * The URL is defined in the second parameter
         * Then we have a Response Listener and a Error Listener
         * In response listener we will get the JSON response as a String
         * and good luck Nabaa hahahahahaha
         * */
        StringRequest stringRequest = new StringRequest(Request.Method.GET, URL_PRODUCTS,
                new Response.Listener<String>(){
                    @Override
                    public void onResponse(String response) {
                        try {
                            //converting the string to json array object
                            JSONArray array = new JSONArray(response);

                            //traversing through all the object
                            for (int i = 0; i < array.length(); i++) {

                                //getting actions object from json array
                                JSONObject cards = array.getJSONObject(i);

                                //adding the actions to cards list
                                cardsList.add(new Cards(
                                        cards.getString("Action"),
                                        cards.getString("Room"),
                                        cards.getString("Appliance")

                                ));
                            }

                            //creating adapter object and setting it to recyclerview
                            CardsAdapter adapter = new CardsAdapter(Pattren.this, cardsList);
                           // setting adapter to recycleview adapter
                            recyclerView.setAdapter(adapter);
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), " Try again later ", Toast.LENGTH_SHORT).show();
                    }
                });

        //adding our string request to queue
        Volley.newRequestQueue(this).add(stringRequest);
    }


}