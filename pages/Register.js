import { StatusBar } from 'expo-status-bar';
import { StyleSheet, Text, View, TextInput, TouchableOpacity, Image } from 'react-native';
import userservice from '../services/UserServices';
import { useState } from 'react';

export default function Register({ navigation }) {
  const img = {
    uri: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQe9CTHW8a-ipNthMQTQVy_byJS3zIfXl7wRg&usqp=CAU'
  };

  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [phone, setPhone] = useState("");
  const [password, setPassword] = useState("");

  const register_customer = async () => {
    console.log("pasword:", password);
    await userservice.Register({
      email: email,
      password: password,
      name: name,
      phone: phone,
    })
      .then(function (result) {
        alert(result.data.message);
        navigation.navigate("Login");
      });
  }




  return (
    <View style={styles.register}>
      <Image source={img} style={styles.imgStyle} />

      <Text style={styles.title}>Register</Text>
      <TextInput placeholder="Tên"
        placeholderTextColor="black"
        underlineColorAndroid="transparent"
        style={styles.txtInput}
        value={name}
        onChangeText={(e) => setName(e)}


      //  onChangeText={(username) => this.setState({ username: username })}
      />
      <TextInput placeholder="Email"
        placeholderTextColor="black"
        underlineColorAndroid="transparent"
        style={styles.txtInput}
        value={email}
        onChangeText={(e) => setEmail(e)}
      />
      <TextInput placeholder="Số điện thoại"
        placeholderTextColor="black"
        underlineColorAndroid="transparent"
        style={styles.txtInput}
        value={phone}
        onChangeText={(e) => setPhone(e)}

      />


      <TextInput placeholder="Mật khẩu"
        underlineColorAndroid="transparent"
        placeholderTextColor="black"
        secureTextEntry={false}
        style={styles.txtInput}
        value={password}
        onChangeText={(e) => setPassword(e)}

      //  onChangeText={(password) => this.setState({ password: password })}
      />
      <TouchableOpacity style={styles.btnRegister}
        onPress={() => {
          register_customer();
        }}>
        <Text style={styles.txtRegister}>Register</Text>
        {/* onPress={() =>
             */}
      </TouchableOpacity>
      <StatusBar style="auto" />
    </View>
  );
}

const styles = StyleSheet.create({

  register: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: './assets/images/bg2.jpg',

  },

  title: {
    fontSize: 30,
    color: 'red'
  },
  txtInput: {
    backgroundColor: 'rgba(0,0,0, 0.1)',
    // width: DEVICE_WIDTH - 40,
    width: 350,
    marginHorizontal: 20,
    padding: 8,
    borderRadius: 20,
    color: '#000',
    marginTop: 2,
    marginBottom: 7,
  },
  btnRegister: {
    //  width: DEVICE_WIDTH - 40,
    backgroundColor: 'rgba(0,145,234,1)',
    padding: 8,
    borderRadius: 20,
    marginTop: 2

  },
  txtRegister: {
    color: '#fff',
    width: 70,
    textAlign: 'center'
  },
  imgStyle: {
    height: 100,
    width: 100,
    alignItems: "center",
    alignItems: 'center',

  }
});