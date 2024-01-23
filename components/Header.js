import { StatusBar } from 'expo-status-bar';
import { FlatList, Image, StyleSheet, Text, TouchableOpacity, View } from 'react-native';


const headers =[
    {
    id: 1,
    image: require('../assets/icons/setting.png'),
    name: 'Setting',

  },

]
export default function Header() {
  const renderHeaderItem = ({ item }) => (

    <TouchableOpacity style={styles.headerItem} >
      {/* <Image source={item.image} style={styles.headerImage} /> */}
      <Text style={styles.headerStyle}>Tucliee</Text>
    </TouchableOpacity>
  );
  return (
    <View style={styles.header}>
      <FlatList
        data={headers}
        renderItem={renderHeaderItem}
        keyExtractor={(item) => item.id}
        contentContainerStyle={styles.headerList}
        numColumns={5}
      />
    </View>
  );
};


const styles = StyleSheet.create({
  header: {
    alignItems: 'center',
    justifyContent: 'center',
  },
  headerStyle :{
    fontSize: 25,
    textAlign: 'center',
    margin: 10,
  },
  headerList: {
    paddingHorizontal: 30,
  },
  headerImage: {
    width: 35,
    height: 35,

  },
  headerItem: {
    alignItems: 'center',
    justifyContent: 'center',
    marginRight:15,
    marginLeft:15,
  },

});