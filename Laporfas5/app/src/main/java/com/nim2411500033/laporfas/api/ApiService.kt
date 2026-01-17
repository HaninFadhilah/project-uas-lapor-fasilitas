package com.nim2411500033.laporfas.api

import com.nim2411500033.laporfas.model.*
import okhttp3.ResponseBody
import retrofit2.Call
import retrofit2.http.*

interface ApiService {


    @FormUrlEncoded
    @POST("login.php")
    fun login(
        @Field("username") username: String,
        @Field("password") password: String
    ): Call<Admin>

    @GET("facility.php")
    fun getFasilitas(): Call<FasilitasResponse>

    @GET("get_report.php")
    fun getLaporan(): Call<LaporanResponse>

    @FormUrlEncoded
    @POST("add_report.php")
    fun tambahLaporan(
        @Field("facility_id") facilityId: Int,
        @Field("deskripsi") deskripsi: String
    ): Call<ResponseBody>

}
