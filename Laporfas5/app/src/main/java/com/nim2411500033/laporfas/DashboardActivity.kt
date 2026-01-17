package com.nim2411500033.laporfas

import android.content.Intent
import android.os.Bundle
import android.widget.Button
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.nim2411500033.laporfas.adapter.LaporanAdapter
import com.nim2411500033.laporfas.api.ApiClient
import com.nim2411500033.laporfas.model.Laporan
import com.nim2411500033.laporfas.model.LaporanResponse
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class DashboardActivity : AppCompatActivity() {

    private lateinit var rvLaporan: RecyclerView
    private lateinit var btnTambah: Button
    private lateinit var adapter: LaporanAdapter
    private val listLaporan = ArrayList<Laporan>()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_dashboard)

        rvLaporan = findViewById(R.id.rvLaporan)
        btnTambah = findViewById(R.id.btnTambah)

        adapter = LaporanAdapter(listLaporan)

        rvLaporan.layoutManager = LinearLayoutManager(this)
        rvLaporan.adapter = adapter
        rvLaporan.setHasFixedSize(true)

        btnTambah.setOnClickListener {
            startActivity(Intent(this, TambahLaporanActivity::class.java))
        }

        loadLaporan()
    }

    private fun loadLaporan() {
        ApiClient.instance.getLaporan()
            .enqueue(object : Callback<LaporanResponse> {

                override fun onResponse(
                    call: Call<LaporanResponse>,
                    response: Response<LaporanResponse>
                ) {
                    if (response.isSuccessful) {
                        val body = response.body()

                        if (body != null && body.status) {
                            listLaporan.clear()
                            listLaporan.addAll(body.data)
                            adapter.notifyDataSetChanged()
                        } else {
                            Toast.makeText(
                                this@DashboardActivity,
                                "Data kosong / status false",
                                Toast.LENGTH_SHORT
                            ).show()
                        }
                    } else {
                        Toast.makeText(
                            this@DashboardActivity,
                            "Response gagal",
                            Toast.LENGTH_SHORT
                        ).show()
                    }
                }

                override fun onFailure(call: Call<LaporanResponse>, t: Throwable) {
                    Toast.makeText(
                        this@DashboardActivity,
                        "Error: ${t.message}",
                        Toast.LENGTH_LONG
                    ).show()
                }
            })
    }

    override fun onResume() {
        super.onResume()
        loadLaporan()
    }
}
