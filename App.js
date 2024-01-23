import { StatusBar } from 'expo-status-bar';
import { StyleSheet, View } from 'react-native';
import AppNavigator from './AppNavigator';
import { Provider } from 'react-redux';
import {store}from './states/index';
export default function App() {
  return (
    <Provider store={store}>
    <View style={styles.container}>
      <AppNavigator></AppNavigator>
       <StatusBar style="auto" />

    </View>
    </Provider>

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