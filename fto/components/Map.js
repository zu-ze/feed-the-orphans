// import React, { useState } from "react";
// import { View, Text, Alert } from "react-native";
// import MapView, { PROVIDER_GOOGLE, Marker, Polyline, } from "react-native-maps";
// import Geolocation from "react-native-geolocation-service";
// import MapViewDirections from "react-native-maps-directions"


// export default class Map extends React.Component {

//   constructor(props) {
//     super(props);
//     this.state = {
//       latitude: 0,
//       longitude: 0,
//       coordinates: [
//         // {
//         //   latitude: 48.8587741,
//         //   longitude: 2.2069771,
//         // },
//         // {
//         //   latitude: 48.8323785,
//         //   longitude: 2.3361663,
//         // }
//         ],
//       };
//     }     

//     componentDidMount()
//     {
//         Geolocation.getCurrentPosition(
//             position => {
//               this.setState({
//                 latitude: position.coords.latitude,
//                 longitude: position.coords.longitude,
//                 coordinates: this.state.coordinates.concat({
//                   latitude: position.coords.latitude,
//                   longitude: position.coords.longitude
//                 })
//               });
//             },
//             error => {
//               Alert.alert(error.message.toString());
//             },
//             {
//               showLocationDialog: true,
//               enableHighAccuracy: true,
//               timeout: 20000,
//               maximumAge: 0
//             }
//           );

//         // Geolocation.watchPosition(
//         //     position => {
//         //         this.setState({
//         //         latitude: position.coords.latitude,
//         //         longitude: position.coords.longitude,
//         //         coordinates: this.state.coordinates.concat({
//         //             latitude: position.coords.latitude,
//         //             longitude: position.coords.longitude
//         //         })
//         //         });
//         //     },
//         //     error => {
//         //         console.log(error);
//         //     },
//         //     {
//         //         showLocationDialog: true,
//         //         enableHighAccuracy: true,
//         //         timeout: 20000,
//         //         maximumAge: 0,
//         //         distanceFilter: 0
//         //     }
//         //     );
//     }

//     render() {
//         return (
//             <View style={{ flex: 1 }}>
//                 <MapView
//                     provider={PROVIDER_GOOGLE}
//                     // customMapStyle={mapStyle}
//                     style={{flex: 1}}
//                     region={{
//                     latitude: this.state.latitude,
//                     longitude: this.state.longitude,
//                     // latitude: this.state.coordinates[0].latitude,
//                     // longitude: this.state.coordinates[0].longitude,
//                     latitudeDelta: 0.0922,
//                     longitudeDelta: 0.0421,
//                     }}>
//                     <Marker
//                         coordinate={{
//                         latitude: this.state.latitude,
//                         longitude: this.state.longitude,
//                       }}
//                     >
//                     </Marker>
//                     {/* <Marker
//                         coordinate={
//                         // latitude: this.state.latitude,
//                         // longitude: this.state.longitude,
//                         this.state.coordinates[1]
//                         }>
//                     </Marker> */}

//                     {/* <Polyline
//                         coordinates={this.state.coordinates}
//                         strokeColor="#bf8221"
//                         strokeColors={[ '#bf8221', '#ffe066', '#ffe066', '#ffe066', '#ffe066', ]}
//                         strokeWidth={3}
//                     /> */}
//                     {/* <Polyline
//                       coordinates={this.state.coordinates}
//                       strokeColor="#000" // fallback for when `strokeColors` is not supported by the map-provider
//                       strokeColors={['#7F0000']}
//                       strokeWidth={6}
//                     /> */}
//                     {/* <MapViewDirections
//                       origin={this.state.coordinates[0]}
//                       destination={this.state.coordinates[1]}
//                       apikey='AIzaSyA-gIQHU-lkEKpy05n7m8P-q1obHdaRWdw' // insert your API Key here
//                       strokeWidth={4}
//                       strokeColor="#111111"
//                     /> */}
//                 </MapView>
//             </View>
//         );
//     }
// }
