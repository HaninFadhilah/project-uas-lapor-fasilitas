package com.nim2411500033.laporfas

import android.os.Bundle
import android.widget.*
import androidx.appcompat.app.AppCompatActivity
import com.nim2411500033.laporfas.api.ApiClient
import com.nim2411500033.laporfas.model.Fasilitas
import com.nim2411500033.laporfas.model.FasilitasResponse
import okhttp3.ResponseBody
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class TambahLaporanActivity : AppCompatActivity() {

    private lateinit var spFasilitas: Spinner
    private lateinit var etDeskripsi: EditText
    private lateinit var btnSimpan: Button

    private val listFasilitas = ArrayList<Fasilitas>()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_tambah_laporan)

        spFasilitas = findViewById(R.id.spFasilitas)
        etDeskripsi = findViewById(R.id.etDeskripsi)
        btnSimpan = findViewById(R.id.btnSimpan)

        loadFasilitas()

        btnSimpan.setOnClickListener {
            simpanLaporan()
        }
    }

    private fun loadFasilitas() {
        ApiClient.instance.getFasilitas()
            .enqueue(object : Callback<FasilitasResponse> {
                override fun onResponse(
                    call: Call<FasilitasResponse>,
                    response: Response<FasilitasResponse>
                ) {
                    if (response.isSuccessful && response.body()?.status == true) {
                        listFasilitas.clear()
                        listFasilitas.addAll(response.body()!!.data)

                        val namaFasilitas = listFasilitas.map { it.nama_fasilitas }

                        val adapter = ArrayAdapter(
                            this@TambahLaporanActivity,
                            android.R.layout.simple_spinner_item,
                            namaFasilitas
                        )
                        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item)
                        spFasilitas.adapter = adapter
                    } else {
                        Toast.makeText(this@TambahLaporanActivity, "Gagal load fasilitas", Toast.LENGTH_SHORT).show()
                    }
                }

                override fun onFailure(call: Call<FasilitasResponse>, t: Throwable) {
                    Toast.makeText(this@TambahLaporanActivity, t.message, Toast.LENGTH_LONG).show()
                }
            })
    }

    private fun simpanLaporan() {
        val deskripsi = etDeskripsi.text.toString()

        if (deskripsi.isEmpty()) {
            etDeskripsi.error = "Deskripsi wajib diisi"
            return
        }

        val fasilitasId = listFasilitas[spFasilitas.selectedItemPosition].id

        ApiClient.instance.tambahLaporan(fasilitasId, deskripsi)
            .enqueue(object : Callback<ResponseBody> {
                override fun onResponse(
                    call: Call<ResponseBody>,
                    response: Response<ResponseBody>
                ) {
                    if (response.isSuccessful) {
                        Toast.makeText(this@TambahLaporanActivity, "Laporan berhasil dikirim", Toast.LENGTH_SHORT).show()
                        finish()
                    } else {
                        Toast.makeText(this@TambahLaporanActivity, "Gagal kirim laporan", Toast.LENGTH_SHORT).show()
                    }
                }

                override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                    Toast.makeText(this@TambahLaporanActivity, t.message, Toast.LENGTH_LONG).show()
                }
            })
    }
}
