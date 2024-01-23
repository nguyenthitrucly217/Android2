import { StatusBar } from 'expo-status-bar';
import { ScrollView, StyleSheet, View } from 'react-native';
import Slider from './Slider';
import Product from './Product';
import Search from './Search';
import Category from './Category';

export default function Home() {
  return (
    
    <View style={styles.container}>
        <ScrollView>
      <Search></Search>
      <Slider></Slider>
      <Category></Category>
      <Product></Product> 
       </ScrollView>
       <StatusBar style="auto" />

    </View>

  
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    // alignItems: 'center',
    // justifyContent: 'center',
  },
});