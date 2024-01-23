import React, { useEffect, useState } from 'react';
import { View, Text, TextInput, TouchableOpacity, Image, StyleSheet, ScrollView } from 'react-native';
import { FontAwesome } from '@expo/vector-icons';
import AsyncStorage from '@react-native-async-storage/async-storage';
import orderservice from '../../services/OrderServices';
import { useDispatch, useSelector } from 'react-redux';
import { useNavigation } from '@react-navigation/native';
import { bindActionCreators } from 'redux';
import * as actionCreate from "../../states/actionCreate";

const Pay = () => {
  const products = useSelector((state) => state.product);
  dispatch = useDispatch();
  const { DELETEALL } = bindActionCreators(actionCreate, dispatch);

  const [name, setName] = useState('');
  const [address, setAddress] = useState('');
  const [phone, setPhone] = useState('');
  const [note, setNote] = useState('');
  const [email, setEmail] = useState('');
  const [iduser, setIduser] = useState();
  const navigation = useNavigation();



  const handlePayment = async () => {
    await orderservice.Thanhtoan({
      "id_user": iduser,
      "name": name,
      "address": address,
      "phone": phone,
      "email": email,
      "note": note,
      "order_detail": products
    }).then(function (result) {
      DELETEALL();
      alert(result.data.message);
      navigation.navigate("Home");
    });
  };
  _retrieveData = async () => {
    try {
      const value = await AsyncStorage.getItem('user');
      if (value !== null) {

        setName(JSON.parse(value).name);
        setAddress(JSON.parse(value).address);
        setPhone(JSON.parse(value).phone);
        setNote(JSON.parse(value).note);
        setEmail(JSON.parse(value).email);
        setIduser(JSON.parse(value).id);





        console.log(value)
      }
    } catch (error) {
      console.error(error);
    }
  };
  useEffect(() => {
    _retrieveData();
  }, []);


  return (
    <ScrollView style={styles.container}>
      <View style={styles.formGroup}>
        <Text style={styles.label}>Họ và tên *</Text>
        <TextInput
          style={styles.input}
          placeholder="Họ và tên"
          value={name}
          onChangeText={setName}
        />
      </View>

      <View style={styles.formGroup}>
        <Text style={styles.label}>Số điện thoại *</Text>
        <TextInput
          style={styles.input}
          placeholder="Nhập số điện thoại"
          value={phone}
          onChangeText={setPhone}
        />
      </View>

      <View style={styles.formGroup}>
        <Text style={styles.label}>Email *</Text>
        <TextInput
          style={styles.input}
          placeholder="Nhập email"
          value={email}
          editable={false}
          onChangeText={setEmail}
        />
      </View>


      <View style={styles.formGroup}>
        <Text style={styles.label}>Địa chỉ *</Text>
        <TextInput
          style={styles.input}
          placeholder="Nhập địa chỉ"
          value={address}
          onChangeText={setAddress}

        />
      </View>
      <View style={styles.formGroup}>
        <Text style={styles.label}>Ghi chú đơn hàng</Text>
        <TextInput
          style={styles.input}
          placeholder="Nhập ghi chú"
          value={note}
          onChangeText={setNote}
        />

      </View>

      <TouchableOpacity style={styles.button} onPress={handlePayment}>
        <Text style={styles.buttonText}>Thanh toán</Text>
      </TouchableOpacity>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 20,
  },
  header: {
    alignItems: 'center',
    marginBottom: 20,
  },
  logo: {
    width: 150,
    height: 40,
    resizeMode: 'contain',
  },
  formGroup: {
    marginBottom: 20,
  },
  label: {
    fontSize: 16,
    marginBottom: 5,
  },
  input: {
    borderWidth: 1,
    borderColor: '#ccc',
    borderRadius: 5,
    paddingVertical: 10,
    paddingHorizontal: 15,
    fontSize: 16,
  },
  paymentOptions: {
    marginBottom: 20,
  },
  paymentLabel: {
    fontSize: 16,
    marginBottom: 10,
  },
  paymentIcons: {
    flexDirection: 'row',
    justifyContent: 'space-between',
  },
  paymentIcon: {
    marginRight: 10,
  },
  button: {
    backgroundColor: '#ee4d2d',
    paddingVertical: 12,
    borderRadius: 5,
  },
  buttonText: {
    color: 'white',
    fontSize: 16,
    fontWeight: 'bold',
    textAlign: 'center',
  },
});

export default Pay;