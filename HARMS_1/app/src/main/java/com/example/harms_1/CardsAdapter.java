package com.example.harms_1;

import android.content.Context;
//import android.support.v7.widget.RecyclerView;
import androidx.recyclerview.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;


import java.util.List;

public class CardsAdapter extends RecyclerView.Adapter<CardsAdapter.CardsViewHolder> {

    //this context we will use to inflate the layout
    private Context mCtx;

    //we are storing all the Cards in a list
    private List<Cards> cardsList;

    //getting the context and cards list with constructor
    public CardsAdapter(Context mCtx, List<Cards> cardsList) {
        this.mCtx = mCtx;
        this.cardsList = cardsList;
    }

    @Override
    public CardsViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        //inflating and returning our view holder
        LayoutInflater inflater = LayoutInflater.from(mCtx);
        View view = inflater.inflate(R.layout.activity_pattern, null);
        return new CardsViewHolder(view);
    }

    @Override
    public void onBindViewHolder(CardsViewHolder holder, int position) {
        //getting the product of the specified position
        Cards cards = cardsList.get(position);

        //binding the data with the viewholder views
        holder.textViewaction.setText(cards.getAction());
        holder.textViewroom.setText(cards.getRoom());
        holder.textViewappliance.setText(cards.getAppliance());

    }

    @Override
    public int getItemCount() {
        return cardsList.size();
    }

    class CardsViewHolder extends RecyclerView.ViewHolder {

        TextView textViewaction, textViewroom, textViewappliance;

        public CardsViewHolder(View itemView) {
            super(itemView);

            textViewaction = itemView.findViewById(R.id.action);
            textViewroom = itemView.findViewById(R.id.room);
            textViewappliance = itemView.findViewById(R.id.appliance);

        }
    }

}
