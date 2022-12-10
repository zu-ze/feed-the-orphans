import * as React from 'react';
import { Button, Text, View } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import Ionicons from 'react-native-vector-icons/Ionicons';
import { RegisterScreen } from './fto/screens/RegisterScreen'; 
import { LoginScreen } from './fto/screens/LoginScreen';
import { HomeScreen } from './fto/screens/HomeScreen';
import { MyAreaScreen } from './fto/screens/MyAreaScreen';
import { UserHomeScreen } from './fto/screens/UserHomeScreen';
import { NotificationScreen } from './fto/screens/NotificationScreen';
import { EventsScreen } from './fto/screens/EventsScreen';
import { FindScreen } from './fto/screens/FindScreen';
import { DonateScreen } from './fto/screens/DonateScreen';
import UserProfileScreen from './fto/screens/UserProfileScreen';
import { ResultScreen } from './fto/screens/ResultScreen';
import OrphanageProfileScreen from './fto/screens/OrphanageProfileScreen';
import { Provider as Provi } from 'react-native-paper'
import allReducers from './fto/reducers';
import { createStore, applyMiddleware } from 'redux';
import { Provider, useSelector } from 'react-redux';
import { composeWithDevTools } from '@redux-devtools/extension';
import { theme } from './fto/core/Theme';

const store = createStore(
  allReducers,
  composeWithDevTools(
    applyMiddleware()
  )
);

const HomeStack = createNativeStackNavigator();

function HomeStackScreen({navigation}: any) {
  return (
    <HomeStack.Navigator
      screenOptions={{
        headerShown: true,
        headerStyle: {
          backgroundColor: "#4b88a2"
        },
        headerTitleStyle: {
          color: "#fff"
        }
      }}
    >
      <HomeStack.Screen name="Home" component={HomeScreen} />
      <HomeStack.Screen name="MyArea" component={MyAreaScreen} 
        options={{
          headerRight: () => (
            <Ionicons name="menu" size={50} style={{padding: 5}} color='white' />
          )
        }}
      />
      <HomeStack.Screen name="Events" component={EventsScreen} />
      <HomeStack.Screen name="Find" component={FindScreen} />
      <HomeStack.Screen name="Result" component={ResultScreen} />
      <HomeStack.Screen name="Donate" component={DonateScreen} />
      <HomeStack.Screen name="Profile" component={OrphanageProfileScreen} />
    </HomeStack.Navigator>
    
  );
}

const NotificationStack = createNativeStackNavigator();

function NotificationStackScreen() {
  return (
    <NotificationStack.Navigator
      screenOptions={{
        headerShown: true,
        headerStyle: {
          backgroundColor: "#4b88a2"
        },
        headerTitleStyle: {
          color: "#fff"
        }
      }}
    >
      <NotificationStack.Screen name="Notifications" component={NotificationScreen} />
    </NotificationStack.Navigator>
  );
}

const UserStack = createNativeStackNavigator();

function UserStackScreen() {
  return (
    <UserStack.Navigator 
      screenOptions={{
        headerTitle: 'Users',
        headerStyle: {
          backgroundColor: "#4b88a2"
        },
        headerTitleStyle: {
          color: "#fff"
        }
        // headerTransparent: true,
      }}
    >
      <UserStack.Screen name="Users" component={UserHomeScreen} />
      <UserStack.Screen name="Register" component={RegisterScreen} />
      <UserStack.Screen name="Login" component={LoginScreen} />
      <UserStack.Screen name="UserProfile" component={UserProfileScreen} />

    </UserStack.Navigator>
  )
}

const Tab = createBottomTabNavigator();

export default function App() {
  var count: any = '';

  const setCount = (value: number) => {
    count = value;
  }

  const getCount = () => count;


  return (
    <Provider store={store} >
      <Provi theme={theme}>
      <NavigationContainer>
        <Tab.Navigator
          screenOptions={({ route }) => ({
            tabBarIcon: ({ focused, color, size }) => {
              let iconName;

              if (route.name === 'Home') {
                iconName = focused
                  ? 'home'
                  : 'home';
              } else if (route.name === 'Notification') {
                iconName = focused ? 'notifications' : 'notifications';
              } else if (route.name === "User") {
                iconName = focused ? 'person' : 'person'
              }

              // You can return any component that you like here!
              return <Ionicons name={iconName} size={size} color={color} />;
            },
            tabBarActiveTintColor: '#f87575',
            tabBarInactiveTintColor: 'white',
            headerShown: false,
            tabBarStyle: {
              backgroundColor: "#4b88a2"
            },

          })}
          
          
        >
          <Tab.Screen name="Home" component={HomeStackScreen} />
          <Tab.Screen name="Notification" 
            component={NotificationStackScreen} 
            options={() => ({
              
              })
            }
            // options={{ 
            //   tabBarBadge: 
            // }}
          />
          <Tab.Screen name="User" component={UserStackScreen} />

        </Tab.Navigator>
      </NavigationContainer>
      </Provi>
    </Provider>
  );
}