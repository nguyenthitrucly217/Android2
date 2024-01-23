import { useNavigation } from '@react-navigation/native';
import React, { useEffect, useState } from 'react';
import { View, StyleSheet, Image, Text, FlatList, TouchableOpacity } from 'react-native';
import categoryservice from '../../services/CategoryServices';
import { urlImage } from "../../config";


const Category = () => {
  const navigation = useNavigation();
  const [category, setCategory]= useState([]);
    const getAPI = async () => {


        await categoryservice.getAll()
            .then(function (result) {
                setCategory(result.data.categories);
            });
    }
    useEffect(() => {
        getAPI();
    }, []);
  const renderCategoryItem = ({ item }) => (

    <TouchableOpacity style={styles.categoryItem}
      onPress={() => {
        navigation.navigate('ProCategory', { idcategory: item });
      }}>


      <Image src={urlImage + "category/"+item.image} style={styles.categoryImage} />
      <Text style={styles.categoryName}>{item.name}</Text>
    </TouchableOpacity>
  );
  return (
    <View style={styles.category}>
      <FlatList
        data={category}
        horizontal={true}
        renderItem={renderCategoryItem}
        contentContainerStyle={styles.categoryList}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  category: {
    alignItems: 'center',
    justifyContent: 'center',

  },
  categoryList: {
    paddingHorizontal: 30,
  },

  categoryName: {
    fontSize: 13,
    fontWeight: 'bold',
    marginBottom: 5,
  },
  categoryImage: {
    width: 50,
    height: 50,
    marginBottom: 5,
    marginTop: 10,

  },
  categoryItem: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
    marginRight: 15,
  },

});

export default Category;