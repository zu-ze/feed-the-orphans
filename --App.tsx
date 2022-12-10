import * as React from 'react';
import {Button} from 'react-native'
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import HomeScreen from './components/homescreen'
import SingleProductScreen from './components/singleproductscreen'
import CreateProductScreen from './components/createproduct';
import {Flex, FlexDirectionBasics} from './components/flex'

const Stack = createNativeStackNavigator();

const App = () => {

  return (
    <NavigationContainer>
      {/* Rest of your app code */}
      <Stack.Navigator
        screenOptions={{
          headerStyle: {
            backgroundColor: '#f4511e',
          },
          headerTintColor: '#fff',
          headerTitleStyle: {
            fontWeight: 'bold',
          },
        }}
      >
        <Stack.Screen
          name="Home"
          component={HomeScreen}
          options={{ title: 'Home',
          // headerRight: () => (
          //   <Button
          //     onPress={() => alert('This is a button!')}
          //     title="..."
          //     color="#feb8"
          //   />
          // ),
        }}
        />
        <Stack.Screen 
          name="SingleProduct" 
          component={SingleProductScreen}
          options={{ title: 'Product'}} 
        />
        <Stack.Screen 
          name="CreateProduct" 
          component={CreateProductScreen}
          options={{ title: 'CreatePost'}} 
        />
      </Stack.Navigator>
    </NavigationContainer>
  );
};

export default App;