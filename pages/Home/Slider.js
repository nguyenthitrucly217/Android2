import React, { useEffect, useState } from 'react';
import { View, StyleSheet, Image, Button } from 'react-native';
import Carousel from 'react-native-snap-carousel';
import sliderservice from "../../services/SliderServices"
import { urlImage } from '../../config';
const Slider = () => {
  const [slider,setSlider]=useState([]);
  // const slides = [
  //   {
  //     id: 1,
  //     image: require('../../assets/images/bg2.jpg'),
  //   },
  //   {
  //     id: 2,
  //     image: require('../../assets/images/bg3.jpg'),
  //   },
  //   {
  //     id: 3,
  //     image: require('../../assets/images/tl1.jpg'),
  //   },
  //   {
  //     id: 4,
  //     image: require('../../assets/images/tl9.jpg'),
  //   },

  //   // Add more slides as needed
  // ];
  const getAPI = async () => {


    await sliderservice.getAll()
        .then(function (result) {
            setSlider(result.data.sliders);
        });
}
useEffect(() => {
    getAPI();
}, []);



  const renderItem = ({ item }) => {
    return (
      <View style={styles.slide}>
        <Image src={urlImage+"slider/"+item.image} style={styles.slideImage} />
      </View>
    );
  };

  return (
    <View style={styles.container}>
      <Carousel
        data={slider}
        renderItem={renderItem}
        sliderWidth={400}
        itemWidth={400}
      />
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    alignItems: 'center',
  },
  slide: {
    width: 400,
    height: 200,
    borderRadius: 10,
    overflow: 'hidden',
  },
  slideImage: {
    width: '100%',
    height: '100%',
  },
});

export default Slider;