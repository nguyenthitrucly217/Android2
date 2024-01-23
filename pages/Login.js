import { StatusBar } from 'expo-status-bar';
import { StyleSheet, Text, View, TextInput, TouchableOpacity, Image } from 'react-native';
import userservice from '../services/UserServices';
import { useState } from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';

export default function Login({ navigation }) {
  const img = {
    uri: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQe9CTHW8a-ipNthMQTQVy_byJS3zIfXl7wRg&usqp=CAU'
  };
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  
  _storeData = async (user) => {
    try {
      await AsyncStorage.setItem(
        'user',JSON.stringify(user)
      );
    } catch (error) {
      // Error saving data
    }
  };
  const dangnhap = async () => {

    await userservice.Login({
      email: email,
      password: password,
    })
      .then(function (result) {
        if (result.data.success == true) {
          alert(result.data.message);
          _storeData(result.data.user[0]);
          navigation.navigate("Home");

        } else {
          alert(result.data.message);
        }
      });

  }





  return (
    <View style={styles.login}>
      <Image source={img} style={styles.imgStyle} />

      <Text style={styles.title}>Login</Text>
      <TextInput placeholder="Email"
        placeholderTextColor="black"
        underlineColorAndroid="transparent"
        style={styles.txtInput}
        value={email}
        onChangeText={(e) => setEmail(e)}
      />
      <TextInput placeholder="Password"
        underlineColorAndroid="transparent"
        placeholderTextColor="black"
        secureTextEntry={true}
        style={styles.txtInput}
        value={password}
        onChangeText={(e) => setPassword(e)}
      />
      <TouchableOpacity
        style={styles.btnLogin}
        onPress={() => {
          dangnhap();
        }}>
        <Text style={styles.txtLogin}>Login</Text>
      </TouchableOpacity>
      <TouchableOpacity
        style={styles.btnLogin}
        onPress={() => {
          navigation.navigate('Register');
        }}>
        <Text style={styles.txtLogin}>Register</Text>
      </TouchableOpacity>
      <StatusBar style="auto" />
    </View>
  );
}

const styles = StyleSheet.create({

  login: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
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
  btnLogin: {
    width: 100,
    //  width: DEVICE_WIDTH - 40,
    backgroundColor: 'rgba(0,145,234,1)',
    padding: 8,
    borderRadius: 20,
    marginTop: 2,
    alignItems: "center",

  },
  txtLogin: {
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