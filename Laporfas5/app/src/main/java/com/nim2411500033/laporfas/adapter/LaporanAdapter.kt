package com.nim2411500033.laporfas.adapter

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.nim2411500033.laporfas.R
import com.nim2411500033.laporfas.model.Laporan

class LaporanAdapter(
    private val list: List<Laporan>
) : RecyclerView.Adapter<LaporanAdapter.ViewHolder>() {

    class ViewHolder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        val tvFasilitas: TextView = itemView.findViewById(R.id.tvFasilitas)
        val tvDeskripsi: TextView = itemView.findViewById(R.id.tvDeskripsi)
        val tvStatus: TextView = itemView.findViewById(R.id.tvStatus)
        val tvTanggal: TextView = itemView.findViewById(R.id.tvTanggal)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_laporan, parent, false)
        return ViewHolder(view)
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val laporan = list[position]

        holder.tvFasilitas.text = laporan.nama_fasilitas
        holder.tvDeskripsi.text = laporan.deskripsi
        holder.tvStatus.text = laporan.status
        holder.tvTanggal.text = laporan.tanggal
    }

    override fun getItemCount(): Int = list.size
}
